<?php

declare(strict_types=1);

namespace WordCounter\Collection;

use PHPUnit\Framework\TestCase;

class WordTest extends TestCase {

    public function testWordObject(): void {
        $word = new Word('Word', 4);

        self::assertEquals('Word', $word->getWord());
        self::assertEquals(4, $word->getCharacterCount());
    }

}