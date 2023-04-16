<?php

declare(strict_types=1);

namespace WordCounter\Contract;

use WordCounter\CharacterUnicodeCollection;

interface LanguageInterface {

    public function getWordUnicodeCollection(): CharacterUnicodeCollection;

}