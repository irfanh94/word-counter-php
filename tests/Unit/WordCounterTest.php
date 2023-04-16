<?php

declare(strict_types=1);

namespace WordCounter\Tests\Unit;

use PHPUnit\Framework\TestCase;
use WordCounter\WordCounter;

class WordCounterTest extends TestCase {

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
            ],
            'assameseLanguage' => [
                'text' => 'হাই, এইটো আৰবী ভাষাৰ পৰীক্ষাৰ সৈতে। এই পৰীক্ষাত অন্তৰ্ভুক্ত হ’ব: ১২৩টা শব্দৰ সংখ্যা আৰু ১২৩টা শব্দৰ তালিকা।',
                'expectedCount' => 20,
                'expectedWords' => [
                    'হাই',
                    'এইটো',
                    'আৰবী',
                    'ভাষাৰ',
                    'পৰীক্ষাৰ',
                    'স',
                    'তে',
                    'এই',
                    'পৰীক্ষাত',
                    'অন্তৰ্ভুক্ত',
                    'হ',
                    'ব',
                    '১২৩টা',
                    'শব্দৰ',
                    'স',
                    'খ্যা',
                    'আৰু',
                    '১২৩টা',
                    'শব্দৰ',
                    'তালিকা',
                ]
            ],
            'englishLanguage' => [
                'text' => 'Hi, this is English language test. This test will include: 123 word numbers and 123 word lists.',
                'expectedCount' => 17,
                'expectedWords' => [
                    'Hi',
                    'this',
                    'is',
                    'English',
                    'language',
                    'test',
                    'This',
                    'test',
                    'will',
                    'include',
                    '123',
                    'word',
                    'numbers',
                    'and',
                    '123',
                    'word',
                    'lists'
                ]
            ]
        ];
    }
}