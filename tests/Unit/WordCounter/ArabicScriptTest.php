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
        $this->wordCounter->registerAllScriptsFromRegistry();
    }

    /** @dataProvider wordCounterData */
    public function testWordCounter(string $text, int $expectedCount, array $expectedWords): void {
        $wordCounterResult = $this->wordCounter->process($text, true);

        $this->assertEquals($expectedCount, $wordCounterResult->getCount());
        $this->assertEquals($expectedWords, $wordCounterResult->getWords());
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
                'expectedCount' => 22,
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
                    'خانواده‌ام',
                    'خرده‌فروشی‌ای',
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