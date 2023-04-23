<?php

declare(strict_types=1);

namespace WordCounter\Tests\Unit\WordCounter;

use PHPUnit\Framework\TestCase;
use WordCounter\WordCounter;

class ArabicScriptTest extends TestCase {

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
            'arabicLanguage' => [
                'text' => 'لقد قمت بشراء ٣ ‍حاسبات جديدة لمكتبي، وستصلن قريباً. ستساعد هذه ‍الحاسبات في تحسين الكفاءة وزيادة الإنتاجية في العمل.',
                'expectedCount' => 19,
                'expectedWords' => [
                    'لقد',
                    'قمت',
                    'بشراء',
                    '٣',
                    'حاسبات',
                    'جديدة',
                    'لمكتبي',
                    'وستصلن',
                    'قريباً',
                    'ستساعد',
                    'هذه',
                    'الحاسبات',
                    'في',
                    'تحسين',
                    'الكفاءة',
                    'وزيادة',
                    'الإنتاجية',
                    'في',
                    'العمل'
                ]
            ],
            'persianLanguage' => [
                'text' => 'من ٣ عدد رمان را خریداری کردم و برای خانواده‌ام خرده‌فروشی‌ای باز کردم تا بتوانیم این محصولات را به مشتریان عرضه کنیم.',
                'expectedCount' => 25,
                'expectedWords' => [
                    'من',
                    '٣',
                    'عدد',
                    'رمان',
                    'را',
                    'خریداری',
                    'کردم',
                    'و',
                    'برای',
                    'خانواده',
                    'ام',
                    'خرده',
                    'فروشی',
                    'ای',
                    'باز',
                    'کردم',
                    'تا',
                    'بتوانیم',
                    'این',
                    'محصولات',
                    'را',
                    'به',
                    'مشتریان',
                    'عرضه',
                    'کنیم'
                ]
            ]
        ];
    }

}