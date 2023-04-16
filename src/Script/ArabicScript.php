<?php

declare(strict_types=1);

namespace WordCounter\Script;

use WordCounter\CharacterUnicodeCollection;
use WordCounter\Contract\ScriptInterface;

class ArabicScript implements ScriptInterface {

    public function getCharacterUnicodeCollection(): CharacterUnicodeCollection {
        $collection = new CharacterUnicodeCollection();
        $collection
            ->addRange(0x0621, 0x063a) // letters
            ->addRange(0x0641, 0x064b) // letters
            ->addRange(0x066e, 0x066f) // letters
            ->addRange(0x0671, 0x06d3) // letters
            ->addRange(0x06fa, 0x06fc) // letters
            ->add(0x06ff) // letter
            ->addRange(0x0750, 0x077f) // supplement letters
            ->addRange(0x08a0, 0x08ff); // extended-a letters

        return $collection;
    }

}