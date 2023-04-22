<?php

declare(strict_types=1);

namespace WordCounter;

use WordCounter\Contract\ScriptInterface;
use WordCounter\Helper\NonPrintableCharacters;
use WordCounter\Helper\ScriptRegistry;

use function in_array;

final class WordCounter {

    private array $supportedCharacterMap = [];
    private array $joiningCharacters = [
        NonPrintableCharacters::ZWNJ,
        NonPrintableCharacters::ZWJ,
    ];

    public function process(string $text, bool $exportWords = false): WordCounterResult {
        $wordCount = 0;
        $wordList = [];

        $textAnalyzer = new TextAnalyzer($text);
        $textAnalyzer->analyze(
            function (?string $previousCharacter, string $currentCharacter, ?string $nextCharacter): bool {
                return $this->onCharacterMatch($previousCharacter, $currentCharacter, $nextCharacter);
            },
            static function (string $word) use (&$wordCount, &$wordList, $exportWords): void {
                $wordCount++;

                if ($exportWords) {
                    $wordList[] = $word;
                }
            }
        );

        return new WordCounterResult($wordCount, $wordList);
    }

    public function registerAllScriptsFromRegistry(): self {
        $supportedScripts = ScriptRegistry::getAllScripts();

        foreach ($supportedScripts as $supportedScript) {
            $this->registerScript($supportedScript);
        }

        return $this;
    }

    public function registerScript(ScriptInterface $script): self {
        $characters = $script->getCharacterCollection()->get();

        foreach ($characters as $character) {
            if (!isset($this->supportedCharacterMap[$character])) {
                $this->supportedCharacterMap[$character] = [];
            }

            $this->supportedCharacterMap[$character][] = $script;
        }

        return $this;
    }

    private function onCharacterMatch(
        ?string $previousCharacter,
        string $currentCharacter,
        ?string $nextCharacter
    ): bool {
        $previousCharacterMatched = $previousCharacter !== null && isset($this->supportedCharacterMap[$previousCharacter]);
        $nextCharacterMatched = $nextCharacter !== null && isset($this->supportedCharacterMap[$nextCharacter]);

        if (isset($this->supportedCharacterMap[$currentCharacter])) {
            return true;
        }

        if (
            $previousCharacterMatched
            && $nextCharacterMatched
            && in_array($currentCharacter, $this->joiningCharacters, true)
        ) {
            return true;
        }

        return false;
    }
}