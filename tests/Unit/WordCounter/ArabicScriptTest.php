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
                'text' => 'مرحبًا ، هذا اختبار اللغة العربية مع. سيتضمن هذا الاختبار: عدد 123 كلمة و 123 كلمة في القائمة.',
                'expectedCount' => 18,
                'expectedWords' => [
                    'مرحب',
                    'ا',
                    'هذا',
                    'اختبار',
                    'اللغة',
                    'العربية',
                    'مع',
                    'سيتضمن',
                    'هذا',
                    'الاختبار',
                    'عدد',
                    '123',
                    'كلمة',
                    'و',
                    '123',
                    'كلمة',
                    'في',
                    'القائمة'
                ]
            ]
        ];
    }

}