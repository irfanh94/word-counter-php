<?php

declare(strict_types=1);

namespace WordCounter;

use WordCounter\Contract\ScriptInterface;
use WordCounter\Helper\NonPrintableCharacters;
use WordCounter\Helper\ScriptRegistry;

final class WordCounter {

    private array $supportedCharacterMap = [];

    public function process(string $text, bool $exportWords = false, string $encoding = 'UTF-8'): WordCounterResult {
        $wordCount = 0;
        $wordList = [];

        $textAnalyzer = new TextAnalyzer($text, $encoding);
        $textAnalyzer->analyze(
            function (string $currentCharacter, ?string $previousCharacter): bool {
                return $this->onCharacterMatch($currentCharacter, $previousCharacter);
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

    private function onCharacterMatch(string $currentCharacterCode, ?string $previousCharacterCode): bool {
        if (
            $currentCharacterCode === NonPrintableCharacters::ZWJ
            && $previousCharacterCode
            && isset($this->supportedCharacterMap[$previousCharacterCode])
        ) {

            return true;
        }

        return isset($this->supportedCharacterMap[$currentCharacterCode]);
    }
}