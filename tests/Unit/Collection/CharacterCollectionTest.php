<?php

declare(strict_types=1);

namespace WordCounter\Collection;

use PHPUnit\Framework\TestCase;

class CharacterCollectionTest extends TestCase {

    public function testCanGet(): void {
        $collection = new CharacterCollection(['a', 'b', 'c']);

        self::assertEquals(['a', 'b', 'c'], $collection->get());
    }

    public function testCanAdd(): void {
        $collection = new CharacterCollection(['a', 'b', 'c']);

        self::assertEquals(['a', 'b', 'c'], $collection->get());

        $collection->add(['d']);

        self::assertEquals(['a', 'b', 'c', 'd'], $collection->get());
    }

    public function testCanRemove(): void {
        $collection = new CharacterCollection(['a', 'b', 'c']);

        self::assertEquals(['a', 'b', 'c'], $collection->get());

        $collection->remove(['b']);

        self::assertEquals(['a', 'c'], $collection->get());
    }

}