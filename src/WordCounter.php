<?php

declare(strict_types=1);

namespace WordCounter;

use WordCounter\Contract\LanguageInterface;
use WordCounter\Helper\LanguageRegistry;
use function mb_substr;
use function mb_ord;

final class WordCounter {

    private array $supportedUnicodeMap = [];

    public function __construct() {
        $supportedLanguages = LanguageRegistry::getAllLanguages();

        foreach ($supportedLanguages as $supportedLanguage) {
            $this->registerLanguage($supportedLanguage);
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
            $charCode = mb_ord($character, 'UTF-8');
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

    public function registerLanguage(LanguageInterface $language): void {
        foreach ($language->getWordUnicodeCollection()->getUnicodeList() as $unicode) {
            if (!isset($this->supportedUnicodeMap[$unicode])) {
                $this->supportedUnicodeMap[$unicode] = [];
            }

            $this->supportedUnicodeMap[$unicode][] = $language;
        }
    }
}