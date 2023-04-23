<?php

declare(strict_types=1);

namespace WordCounter\Tests\Unit\WordCounter;

use PHPUnit\Framework\TestCase;
use WordCounter\WordCounter;

class LatinScriptTest extends TestCase {

    private WordCounter $wordCounter;

    protected function setUp(): void {
        parent::setUp();

        $this->wordCounter = WordCounter::buildWithDefaults();
    }

    /** @dataProvider wordCounterData */
    public function testWordCounter(string $text, int $expectedCount, array $expectedWords): void {
        $wordCounterResult = $this->wordCounter->process($text, true);

        $this->assertEquals($expectedWords, $wordCounterResult->getWords()->toArray());
        $this->assertEquals($expectedCount, $wordCounterResult->getCount());
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
            ],
            'germanLanguage' => [
                'text' => 'Die 3. Auf‌lage des Buches ist ab sofort erhältlich. Diese Version enthält viele neue Erkenntnisse und Informationen, die für Leserinnen und Leser sehr interessant sein könnten',
                'expectedCount' => 27,
                'expectedWords' => [
                    'Die',
                    '3',
                    'Auf',
                    'lage',
                    'des',
                    'Buches',
                    'ist',
                    'ab',
                    'sofort',
                    'erhältlich',
                    'Diese',
                    'Version',
                    'enthält',
                    'viele',
                    'neue',
                    'Erkenntnisse',
                    'und',
                    'Informationen',
                    'die',
                    'für',
                    'Leserinnen',
                    'und',
                    'Leser',
                    'sehr',
                    'interessant',
                    'sein',
                    'könnten'
                ]
            ],
            'bosnianLanguage' => [
                'text' => 'Test iz engleskog jezika. Sadrži: 123 broja i 123 riječi.',
                'expectedCount' => 10,
                'expectedWords' => [
                    'Test',
                    'iz',
                    'engleskog',
                    'jezika',
                    'Sadrži',
                    '123',
                    'broja',
                    'i',
                    '123',
                    'riječi',
                ]
            ],
            'czechLanguage' => [
                'text' => 'Zkouška z anglického jazyka. Obsahuje: 123 čísel a 123 slov.',
                'expectedCount' => 10,
                'expectedWords' => [
                    'Zkouška',
                    'z',
                    'anglického',
                    'jazyka',
                    'Obsahuje',
                    '123',
                    'čísel',
                    'a',
                    '123',
                    'slov',
                ]
            ]
        ];
    }

}