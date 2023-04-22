<?php

declare(strict_types=1);

namespace WordCounter\Tests\Unit\WordCounter;

use PHPUnit\Framework\TestCase;
use WordCounter\WordCounter;

class CyrillicScriptTest extends TestCase {

    private WordCounter $wordCounter;

    protected function setUp(): void {
        parent::setUp();

        $this->wordCounter = new WordCounter();
        $this->wordCounter->registerAllScriptsFromRegistry();
    }

    /** @dataProvider wordCounterData */
    public function testWordCounter(string $text, int $expectedCount, array $expectedWords): void {
        $wordCounterResult = $this->wordCounter->process($text, true);

        $this->assertEquals($expectedWords, $wordCounterResult->getWords());
        $this->assertEquals($expectedCount, $wordCounterResult->getCount());
    }

    public static function wordCounterData(): array {
        return [
            'russianLanguage' => [
                'text' => 'Мой номер телефона +7 (9‍8‍2) 123-4‍5-6‍7. Я живу в квартире номер 3‍7 на 4‍ом этаже здания. Вчера я купил 2‍ килограмма яблок и 1‍5 килограммов груш. Сегодня я буду заниматься спортом с 1‍0 до 1‍2 часов.',
                'expectedCount' => 38,
                'expectedWords' => [
                    'Мой',
                    'номер',
                    'телефона',
                    '7',
                    '9‍8‍2',
                    '123',
                    '4‍5',
                    '6‍7',
                    'Я',
                    'живу',
                    'в',
                    'квартире',
                    'номер',
                    '3‍7',
                    'на',
                    '4‍ом',
                    'этаже',
                    'здания',
                    'Вчера',
                    'я',
                    'купил',
                    '2',
                    'килограмма',
                    'яблок',
                    'и',
                    '1‍5',
                    'килограммов',
                    'груш',
                    'Сегодня',
                    'я',
                    'буду',
                    'заниматься',
                    'спортом',
                    'с',
                    '1‍0',
                    'до',
                    '1‍2',
                    'часов',
                ]
            ],
            'serbianLanguage' => [
                'text' => 'Живела-била‍Љубица‌12',
                'expectedCount' => 2,
                'expectedWords' => [
                    'Живела',
                    'била‍Љубица‌12'
                ]
            ],
            'macedonianLanguage' => [
                'text' => 'Живеела-била‍Магдалена‌34',
                'expectedCount' => 2,
                'expectedWords' => [
                    'Живеела',
                    'била‍Магдалена‌34'
                ]
            ],
            'bulgarianLanguage' => [
                'text' => 'Живеела-била‍Мария‌56',
                'expectedCount' => 2,
                'expectedWords' => [
                    'Живеела',
                    'била‍Мария‌56'
                ]
            ],
            'bashkirLanguage' => [
                'text' => 'Уҡба-муҡба‍Әлминур‍78',
                'expectedCount' => 2,
                'expectedWords' => [
                    'Уҡба',
                    'муҡба‍Әлминур‍78'
                ]
            ],
            'chukchiLanguage' => [
                'text' => 'Ху-ху-чучча‍Тырыппын‌90',
                'expectedCount' => 3,
                'expectedWords' => [
                    'Ху',
                    'ху',
                    'чучча‍Тырыппын‌90'
                ]
            ],
            'khakasLanguage' => [
                'text' => 'Туруу-туруу‍Алтынай‌67',
                'expectedCount' => 2,
                'expectedWords' => [
                    'Туруу',
                    'туруу‍Алтынай‌67'
                ]
            ],
            'ossetianLanguage' => [
                'text' => 'Дзæудзин-пæрис‍Ирæна‌23',
                'expectedCount' => 2,
                'expectedWords' => [
                    'Дзæудзин',
                    'пæрис‍Ирæна‌23'
                ]
            ],
            'abhkazLanguage' => [
                'text' => 'Аи-аиаа‍Маргарита‌45',
                'expectedCount' => 2,
                'expectedWords' => [
                    'Аи',
                    'аиаа‍Маргарита‌45'
                ]
            ]
        ];
    }

}