<?php

declare(strict_types=1);

namespace WordCounter\Helper;

use PHPUnit\Framework\TestCase;

class CharacterJoinersTest extends TestCase {

    public function testCanMatchJoinerCharacters(): void {
        $characterJoiners = new CharacterJoiners();

        self::assertEquals([
            NonPrintableCharacters::ZWJ
        ], $characterJoiners->getCharacterCollection()->get());
    }

}