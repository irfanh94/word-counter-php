<?php

declare(strict_types=1);

namespace WordCounter;

use Closure;

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
        $previousCharacter = null;
        $inWord = false;
        $word = '';

        for ($characterIndex = 0; $characterIndex < $this->textLength; $characterIndex++) {
            $currentCharacter = mb_substr($this->text, $characterIndex, 1, $this->textEncoding);

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
        }

        if ($inWord && $onWordDetect) {
            $onWordDetect($word);
        }
    }

}