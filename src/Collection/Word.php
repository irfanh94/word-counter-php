<?php

declare(strict_types=1);

namespace WordCounter\Collection;

class Word {

    private string $word;
    private int $characterCount;

    public function __construct(string $word, int $characterCount) {
        $this->word = $word;
        $this->characterCount = $characterCount;
    }

    public function getWord(): string {
        return $this->word;
    }

    public function getCharacterCount(): int {
        return $this->characterCount;
    }

    public function __toString(): string {
        return $this->word;
    }

}