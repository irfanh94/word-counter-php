<?php

declare(strict_types=1);

namespace WordCounter;

use Closure;

use function ord;
use function pack;

final class TextAnalyzer {

    private string $text;
    private int $currentProcessingCharacterIndex = 0;

    public function __construct(string $text) {
        $this->text = $text;
    }

    public function analyze(Closure $onCharacterMatch, ?Closure $onWordDetect = null): void {
        $previousCharacter = null;
        $inWord = false;
        $word = '';

        do {
            $currentCharacter = $this->takeNextCharacterFromText();

            if ($currentCharacter === null) {
                break;
            }

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
        } while (true);

        if ($inWord && $onWordDetect) {
            $onWordDetect($word);
        }

        $this->currentProcessingCharacterIndex = 0;
    }

    public function takeNextByteFromText(): ?int {
        $char = $this->text[$this->currentProcessingCharacterIndex] ?? null;

        if ($char === null) {
            return null;
        }

        $this->currentProcessingCharacterIndex++;

        return ord($char);
    }

    public function takeNextCharacterFromText(): ?string {
        $dec = $this->takeNextByteFromText();

        if ($dec === null) {
            return null;
        }

        $bytes = [$dec];
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
            $proceedingByte = $this->takeNextByteFromText();

            if ($proceedingByte !== null) {
                $bytes[] = $proceedingByte;
            }
        }

        return pack('C*', ...$bytes);
    }

}