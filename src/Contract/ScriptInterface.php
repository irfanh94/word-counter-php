<?php

declare(strict_types=1);

namespace WordCounter\Contract;

use WordCounter\Collection\CharacterCollection;

interface ScriptInterface {

    public function getName(): string;
    public function getCharacterCollection(): CharacterCollection;

}