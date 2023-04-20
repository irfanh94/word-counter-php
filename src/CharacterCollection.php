<?php

declare(strict_types=1);

namespace WordCounter;

use function in_array;

class CharacterCollection {

    private array $characters = [];

    public function add(array $characters): void {
        foreach ($characters as $character) {
            if (!in_array($character, $this->characters, true)) {
                $this->characters[] = $character;
            }
        }
    }

    public function get(): array {
        return $this->characters;
    }

}