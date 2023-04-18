<?php

declare(strict_types=1);

namespace WordCounter\Tests\Unit\WordCounter;

use PHPUnit\Framework\TestCase;
use WordCounter\WordCounter;

class ArabicScriptTest extends TestCase {

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
            'arabicLanguage' => [
                'text' => 'اختبار اللغة الإنجليزية. يتضمن: 123 رقمًا و 123 كلمة.',
                'expectedCount' => 9,
                'expectedWords' => [
                    'اختبار',
                    'اللغة',
                    'الإنجليزية',
                    'يتضمن',
                    '123',
                    'رقمًا',
                    'و',
                    '123',
                    'كلمة',
                ]
            ],
            'persianLanguage' => [
                'text' => 'آزمون زبان انگلیسی. این شامل: 123 عدد و 123 کلمه است.',
                'expectedCount' => 11,
                'expectedWords' => [
                    'آزمون',
                    'زبان',
                    'انگلیسی',
                    'این',
                    'شامل',
                    '123',
                    'عدد',
                    'و',
                    '123',
                    'کلمه',
                    'است',
                ]
            ]
        ];
    }

}