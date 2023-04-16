<?php

declare(strict_types=1);

namespace WordCounter\Contract;

use WordCounter\CharacterUnicodeCollection;

interface ScriptInterface {

    public function getCharacterUnicodeCollection(): CharacterUnicodeCollection;

}