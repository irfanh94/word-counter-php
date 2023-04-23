<?php

declare(strict_types=1);

namespace WordCounter\Helper;

use WordCounter\Collection\CharacterCollection;

class CharacterJoiners {

    private CharacterCollection $characterCollection;

    public function __construct() {
        $this->characterCollection = new CharacterCollection([
            NonPrintableCharacters::ZWJ,
        ]);
    }

    public function getCharacterCollection(): CharacterCollection {
        return $this->characterCollection;
    }

}