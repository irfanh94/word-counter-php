<?php

declare(strict_types=1);

namespace WordCounter;

use Closure;
use function mb_ord;
use function mb_strlen;
use function mb_substr;

final class TextAnalyzer {

    private string $text;
    private int $textLength;
    private string $textEncoding;

    public function __construct(string $text, string $textEncoding = 'UTF-8') {
        $this->text = $text;
        $this->textLength = mb_strlen($text, $textEncoding);
        $this->textEncoding = $textEncoding;
    }

    public function analyze(Closure $onCharacterMatch, ?Closure $onWordDetect = null): void {
        $previousCharacterCode = null;
        $inWord = false;
        $word = '';

        for ($characterIndex = 0; $characterIndex < $this->textLength; $characterIndex++) {
            $currentCharacter = mb_substr($this->text, $characterIndex, 1, $this->textEncoding);
            $currentCharacterCode = mb_ord($currentCharacter);

            $isCharacterMatch = $onCharacterMatch($currentCharacterCode, $previousCharacterCode) === true;

            if ($isCharacterMatch) {
                $inWord = true;
            } elseif ($inWord) {
                if ($onWordDetect) {
                    $onWordDetect($word);
                }

                $inWord = false;
                $word = '';
            }

            if ($inWord) {
                $word .= $currentCharacter;
            }

            $previousCharacterCode = $currentCharacterCode;
        }

        if ($inWord && $onWordDetect) {
            $onWordDetect($word);
        }
    }

}