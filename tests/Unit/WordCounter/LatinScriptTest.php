<?php

declare(strict_types=1);

namespace WordCounter\Tests\Unit\WordCounter;

use PHPUnit\Framework\TestCase;
use WordCounter\WordCounter;

class LatinScriptTest extends TestCase {

    private WordCounter $wordCounter;

    protected function setUp(): void {
        parent::setUp();

        $this->wordCounter = new WordCounter();
    }

    /** @dataProvider wordCounterData */
    public function testWordCounter(string $text, int $expectedCount, array $expectedWords): void {
        $wordCounterResult = $this->wordCounter->count($text, true);

        $this->assertEquals($expectedCount, $wordCounterResult->getCount());
        $this->assertEquals($expectedWords, $wordCounterResult->getWords());
    }

    public static function wordCounterData(): array {
        return [
            'englishLanguage' => [
                'text' => 'English language test. It includes: 123 numbers and 123 words.',
                'expectedCount' => 10,
                'expectedWords' => [
                    'English',
                    'language',
                    'test',
                    'It',
                    'includes',
                    '123',
                    'numbers',
                    'and',
                    '123',
                    'words'
                ]
            ],
            'portugueseLanguage' => [
                'text' => 'teste de língua inglesa. Inclui: 123 números e 123 palavras.',
                'expectedCount' => 10,
                'expectedWords' => [
                    'teste',
                    'de',
                    'língua',
                    'inglesa',
                    'Inclui',
                    '123',
                    'números',
                    'e',
                    '123',
                    'palavras',
                ]
            ]
        ];
    }

}