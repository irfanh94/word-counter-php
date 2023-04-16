<?php

declare(strict_types=1);

namespace WordCounter;

use WordCounter\Contract\ScriptInterface;
use WordCounter\Helper\ScriptRegistry;
use function bin2hex;
use function hexdec;
use function mb_substr;

final class WordCounter {

    private array $supportedUnicodeMap = [];

    public function __construct() {
        $supportedScripts = ScriptRegistry::getAllScripts();

        foreach ($supportedScripts as $supportedScript) {
            $this->registerScript($supportedScript);
        }
    }

    public function count(string $text, bool $exportWords = false, string $encoding = 'UTF-8'): WordCounterResult {
        $wordCount = 0;
        $wordList = [];
        $wordTemporary = '';

        $textLength = mb_strlen($text, $encoding);
        $inWord = false;

        for ($charIndex = 0; $charIndex < $textLength; $charIndex++) {
            $character = mb_substr($text, $charIndex, 1, $encoding);
            $charCode = hexdec(bin2hex($character));
            $isWordCharacter = isset($this->supportedUnicodeMap[$charCode]);

            if ($isWordCharacter) {
                $inWord = true;
            } elseif ($inWord) {
                $wordCount++;
                $inWord = false;

                if ($exportWords) {
                    $wordList[] = $wordTemporary;
                    $wordTemporary = '';
                }
            }

            if ($inWord && $exportWords) {
                $wordTemporary .= $character;
            }
        }

        if ($inWord) {
            $wordCount++;
        }

        return new WordCounterResult($wordCount, $wordList);
    }

    public function registerScript(ScriptInterface $script): void {
        $unicodeList = $script->getCharacterUnicodeCollection()->getList();

        foreach ($unicodeList as $unicode) {
            if (!isset($this->supportedUnicodeMap[$unicode])) {
                $this->supportedUnicodeMap[$unicode] = [];
            }

            $this->supportedUnicodeMap[$unicode][] = $script;
        }
    }
}