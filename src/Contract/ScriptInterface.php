<?php

declare(strict_types=1);

namespace WordCounter\Contract;

use WordCounter\CharacterCollection;

interface ScriptInterface {

    public function getCharacterCollection(): CharacterCollection;

}