<?php

declare(strict_types=1);

namespace WordCounter\Tests\Unit\Iterator;

use PHPUnit\Framework\TestCase;
use WordCounter\Iterator\CharacterIterator;

class CharacterIteratorTest extends TestCase {

    public function testCanIterateThroughString(): void {
        $text = 'a‍αаاअ一あㅏ龍b藤บשcصЩ🤯🦄麻漢락憂';

        $iteratedPrevious = [];
        $iteratedCurrent = [];
        $iteratedNext = [];

        $characterIterator = new CharacterIterator($text);

        $characterIterator->iterate(
            static function (?string $previous, string $current, ?string $next) use (&$iteratedPrevious, &$iteratedCurrent, &$iteratedNext): void {
                $iteratedPrevious[] = $previous;
                $iteratedCurrent[] = $current;
                $iteratedNext[] = $next;
            }
        );

        self::assertEquals([null, 'a', '‍', 'α', 'а', 'ا', 'अ', '一', 'あ', 'ㅏ', '龍', 'b', '藤', 'บ', 'ש', 'c', 'ص', 'Щ', '🤯', '🦄', '麻', '漢', '락'], $iteratedPrevious);
        self::assertEquals(['a', '‍', 'α', 'а', 'ا', 'अ', '一', 'あ', 'ㅏ', '龍', 'b', '藤', 'บ', 'ש', 'c', 'ص', 'Щ', '🤯', '🦄', '麻', '漢', '락', '憂'], $iteratedCurrent);
        self::assertEquals(['‍', 'α', 'а', 'ا', 'अ', '一', 'あ', 'ㅏ', '龍', 'b', '藤', 'บ', 'ש', 'c', 'ص', 'Щ', '🤯', '🦄', '麻', '漢', '락', '憂', null], $iteratedNext);
    }

}