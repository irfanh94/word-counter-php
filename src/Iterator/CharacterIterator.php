<?php

declare(strict_types=1);

namespace WordCounter\Iterator;

use Closure;

use function ord;
use function strlen;

final class CharacterIterator {

    private string $text;

    public function __construct(string $text) {
        $this->text = $text;
    }

    public function iterate(Closure $onCharacter): void {
        $maxPosition = strlen($this->text) - 1;
        $position = 0;
        $previousCharacter = null;
        $currentCharacter = $this->takeCharacter($position);

        while ($position <= $maxPosition) {
            $position += strlen($currentCharacter);

            $nextCharacter = ($position <= $maxPosition) ? $this->takeCharacter($position) : null;

            $onCharacter($previousCharacter, $currentCharacter, $nextCharacter);

            $previousCharacter = $currentCharacter;
            $currentCharacter = $nextCharacter;
        }
    }

    private function takeCharacter(int $position): ?string {
        $byte = ord($this->text[$position]);

        if ($byte < 128) {
            $character = $this->text[$position];
        } elseif ($byte < 224) {
            $character = $this->text[$position] . $this->text[$position + 1];
        } elseif ($byte < 240) {
            $character = $this->text[$position] . $this->text[$position + 1] . $this->text[$position + 2];
        } else {
            $character = $this->text[$position] . $this->text[$position + 1] . $this->text[$position + 2] . $this->text[$position + 3];
        }

        return $character;
    }

}