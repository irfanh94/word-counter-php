<?php

declare(strict_types=1);

namespace WordCounter\Tests\Unit\Collection;

use PHPUnit\Framework\TestCase;
use WordCounter\Collection\Word;
use WordCounter\Collection\WordCollection;

class WordCollectionTest extends TestCase {

    public function testCanIterateWords(): void {
        $expected = [
            new Word('first', 5),
            new Word('second', 6),
        ];

        $wordCollection = new WordCollection($expected);

        $actual = [];
        foreach ($wordCollection as $word) {
            $actual[] = $word;
        }

        self::assertEquals($expected, $actual);
    }

    public function testCanOutputArray(): void {
        $words = [
            new Word('first', 5),
            new Word('second', 6),
        ];

        $wordCollection = new WordCollection($words);

        self::assertEquals(['first', 'second'], $wordCollection->toArray());
    }

}