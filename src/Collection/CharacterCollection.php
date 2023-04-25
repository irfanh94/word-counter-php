<?php

declare(strict_types=1);

namespace WordCounter\Collection;

use function array_search;
use function array_values;
use function in_array;

class CharacterCollection {

    private array $characters = [];

    public function __construct(array $characters = []) {
        $this->add($characters);
    }

    public function add(array $characters): void {
        foreach ($characters as $character) {
            if (!in_array($character, $this->characters, true)) {
                $this->characters[] = $character;
            }
        }
    }

    public function remove(array $characters): void {
        foreach ($characters as $character) {
            $index = array_search($character, $this->characters, true);

            if ($index >= 0) {
                unset($this->characters[$index]);
            }
        }

        $this->characters = array_values($this->characters);
    }

    public function get(): array {
        return $this->characters;
    }

}