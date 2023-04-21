<?php

declare(strict_types=1);

namespace WordCounter;

use Closure;

final class TextAnalyzer {

    private string $textHexadecimals;

    public function __construct(string $text) {
        $this->textHexadecimals = bin2hex($text);
    }

    public function analyze(Closure $onCharacterMatch, ?Closure $onWordDetect = null): void {
        $previousCharacter = null;
        $inWord = false;
        $word = '';

        do {
            $currentCharacter = $this->takeNextCharacterFromTextHexadecimals();
            $isCharacterMatch = $onCharacterMatch($currentCharacter, $previousCharacter) === true;

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

            $previousCharacter = $currentCharacter;
        } while ($this->textHexadecimals !== '');

        if ($inWord && $onWordDetect) {
            $onWordDetect($word);
        }
    }

    public function takeNextHexFromTextHexadecimals(): string {
        $hex = substr($this->textHexadecimals, 0, 2);
        $this->textHexadecimals = substr($this->textHexadecimals, 2);

        return $hex;
    }

    public function takeNextCharacterFromTextHexadecimals(): string {
        $hex = $this->takeNextHexFromTextHexadecimals();
        $dec = hexdec($hex);
        $numberOfProceedingHex = 0;

        if ($dec >= 128) {
            if (($dec >> 5) === 6) {
                $numberOfProceedingHex = 1;
            } elseif (($dec >> 4) === 14) {
                $numberOfProceedingHex = 2;
            } elseif (($dec >> 3) === 30) {
                $numberOfProceedingHex = 3;
            }
        }

        for ($a = 0; $a < $numberOfProceedingHex; $a++) {
            $hex .= $this->takeNextHexFromTextHexadecimals();
        }

        return hex2bin($hex);
    }

}