<?php

declare(strict_types=1);

namespace WordCounter\Language;

use WordCounter\CharacterUnicodeCollection;
use WordCounter\Contract\LanguageInterface;

class EnglishLanguage implements LanguageInterface {

    public function getWordUnicodeCollection(): CharacterUnicodeCollection {
        $collection = new CharacterUnicodeCollection();

        $collection
            ->addRange(0x30, 0x39) // numbers
            ->addRange(0x61, 0x7a) // lowercase
            ->addRange(0x41, 0x5a); // uppercase

        return $collection;
    }

}