<?php

declare(strict_types=1);

namespace WordCounter;

use WordCounter\Collection\WordCollection;

final class WordCounterResult {

    private int $count;
    private ?WordCollection $words;

    public function __construct(int $count = 0, ?WordCollection $words = null) {
        $this->count = $count;
        $this->words = $words;
    }

    public function getCount(): int {
        return $this->count;
    }

    public function getWords(): ?WordCollection {
        return $this->words;
    }

}