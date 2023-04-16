<?php

declare(strict_types=1);

namespace WordCounter;

final class WordCounterResult {

    private int $count;
    private array $words;

    public function __construct(int $count = 0, array $words = []) {
        $this->count = $count;
        $this->words = $words;
    }

    public function getCount(): int {
        return $this->count;
    }

    public function getWords(): array {
        return $this->words;
    }

}