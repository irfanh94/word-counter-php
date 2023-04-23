<?php

declare(strict_types=1);

namespace WordCounter\Collection;

use Iterator;

class WordCollection implements Iterator {

    private array $items = [];
    private int $iteratorPosition = 0;

    public function __construct(array $items = []) {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    public function add(Word $word): void {
        $this->items[] = $word;
    }

    public function current(): Word {
        return $this->items[$this->iteratorPosition];
    }

    public function next(): void {
        ++$this->iteratorPosition;
    }

    public function key(): mixed {
        return $this->iteratorPosition;
    }

    public function valid(): bool {
        return isset($this->iteratorPosition);
    }

    public function rewind(): void {
        $this->iteratorPosition = 0;
    }

    public function toArray(): array {
        $words = [];

        foreach ($this->items as $item) {
            $words[] = $item->getWord();
        }

        return $words;
    }
}