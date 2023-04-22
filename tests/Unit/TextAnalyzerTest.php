<?php

declare(strict_types=1);

namespace WordCounter\Tests\Unit;

use PHPUnit\Framework\TestCase;
use WordCounter\TextAnalyzer;

class TextAnalyzerTest extends TestCase {

    public function testCanAnalyzeText(): void {
        $expected = 'a‍αаاअ一あㅏ龍b藤บשcصЩ🤯🦄麻漢락憂';
        $processed = '';

        $textAnalyzer = new TextAnalyzer($expected);
        $textAnalyzer->analyze(
            static function(): bool {
                return true;
            },
            static function(string $word) use (&$processed): void {
                $processed = $word;
            }
        );

        static::assertEquals($processed, $processed);
    }

}