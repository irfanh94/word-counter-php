<?php

declare(strict_types=1);

namespace WordCounter\Language;

use WordCounter\CharacterUnicodeCollection;
use WordCounter\Contract\LanguageInterface;

class AssameseLanguage implements LanguageInterface {

    public function getWordUnicodeCollection(): CharacterUnicodeCollection {
        $collection = new CharacterUnicodeCollection();

        $collection
            ->addRange(0x30, 0x39) // Arabic numbers
            ->addRange(0x9e6, 0x9ef) // Arabic numbers
            ->addRange(0x9e6, 0x9ef) // Assamese numbers
            ->addRange(0x985, 0x98c) // Assamese script
            ->addRange(0x98f, 0x990) // Assamese script
            ->addRange(0x993, 0x9a8) // Assamese script
            ->addRange(0x9aa, 0x9b0) // Assamese script
            ->addRange(0x9b2, 0x9b9) // Assamese script
            ->addRange(0x9dc, 0x9dd) // Assamese script
            ->addRange(0x9e0, 0x9e3) // Assamese script
            ->addRange(0x9f0, 0x9f1) // Assamese script
            ->addRange(0x9bc, 0x9bd) // Assamese script
            ->addRange(0x9be, 0x9c4) // Assamese script
            ->addRange(0x9cb, 0x9cd) // Assamese script
            ->addRange(0x9d7, 0x9d9) // Assamese script
            ->addList([0x9c7, 0x9ce]) // Assamese script
            ->add(0x9df) // Assamese letter bengali ra
            ->add(0xe28099); // ’

        return $collection;
    }

}