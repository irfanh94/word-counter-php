<?php

declare(strict_types=1);

namespace WordCounter\Script;

use WordCounter\CharacterUnicodeCollection;
use WordCounter\Contract\ScriptInterface;

class ArabicScript implements ScriptInterface {

    public function getCharacterUnicodeCollection(): CharacterUnicodeCollection {
        $collection = new CharacterUnicodeCollection();

        $collection
            ->addRange(0x30, 0x39) // Arabic numbers
            ->addRange(0x621, 0x63a) // Arabic script
            ->addRange(0x640, 0x64a) // Arabic script
            ->addRange(0x6f0, 0x6f9) // Eastern Arabic numbers
            ->addRange(0x6fa, 0x6fc) // Arabic script
            ->add(0x6ff) // Arabic letter mark
            ->add(0x66f); // Arabic letter dotless final beh


        return $collection;
    }

}