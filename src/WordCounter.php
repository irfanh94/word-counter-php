<?php

declare(strict_types=1);

namespace WordCounter;

use WordCounter\Contract\ScriptInterface;
use WordCounter\Helper\NonPrintableCharacters;
use WordCounter\Helper\ScriptRegistry;

final class WordCounter {

    private array $supportedUnicodeMap = [];

    public function process(string $text, bool $exportWords = false, string $encoding = 'UTF-8'): WordCounterResult {
        $wordCount = 0;
        $wordList = [];

        $textAnalyzer = new TextAnalyzer($text, $encoding);
        $textAnalyzer->analyze(
            function (int $currentCharacterCode, ?int $previousCharacterCode): bool {
                return $this->onCharacterMatch($currentCharacterCode, $previousCharacterCode);
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
        $unicodeList = $script->getCharacterUnicodeCollection()->getList();

        foreach ($unicodeList as $unicode) {
            if (!isset($this->supportedUnicodeMap[$unicode])) {
                $this->supportedUnicodeMap[$unicode] = [];
            }

            $this->supportedUnicodeMap[$unicode][] = $script;
        }

        return $this;
    }

    private function onCharacterMatch(int $currentCharacterCode, ?int $previousCharacterCode): bool {
        if (
            $currentCharacterCode === NonPrintableCharacters::ZWJ
            && $previousCharacterCode
            && isset($this->supportedUnicodeMap[$previousCharacterCode])
        ) {
            return true;
        }

        return isset($this->supportedUnicodeMap[$currentCharacterCode]);
    }
}