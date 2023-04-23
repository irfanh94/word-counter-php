<?php

declare(strict_types=1);

namespace WordCounter\Tests\Unit;

use Mockery;
use PHPUnit\Framework\TestCase;
use WordCounter\Collection\CharacterCollection;
use WordCounter\Collection\Word;
use WordCounter\Collection\WordCollection;
use WordCounter\Contract\ScriptInterface;
use WordCounter\Script\LatinScript;
use WordCounter\WordCounter;

class WordCounterTest extends TestCase {

    public function testCanOnlyCount(): void {
        $wordCounter = WordCounter::buildWithDefaults();
        $wordCounterResult = $wordCounter->process('Amazing text');

        self::assertEquals(2, $wordCounterResult->getCount());
        self::assertEquals(new WordCollection(), $wordCounterResult->getWords());
    }

    public function testCanExportWords(): void {
        $wordCounter = WordCounter::buildWithDefaults();
        $wordCounterResult = $wordCounter->process('Amazing text', true);

        self::assertEquals(2, $wordCounterResult->getCount());
        self::assertEquals(
            new WordCollection([
                new Word('Amazing', 7),
                new Word('text', 4)
            ]),
            $wordCounterResult->getWords()
        );
    }

    public function testCanRegisterScript(): void {
        $wordCounter = new WordCounter();
        $wordCounterResponse = $wordCounter->process('Amazing text', true);

        self::assertEquals(0, $wordCounterResponse->getCount());
        self::assertEquals([], $wordCounterResponse->getWords()->toArray());

        $wordCounter->registerScript(new LatinScript());
        $wordCounterResponse = $wordCounter->process('Amazing text', true);

        self::assertEquals(2, $wordCounterResponse->getCount());
        self::assertEquals(['Amazing', 'text'], $wordCounterResponse->getWords()->toArray());
    }

    public function testCanRegisterScriptWithOverwrite(): void {
        $latinScript = new LatinScript();
        $wordCounter = new WordCounter();
        $wordCounter->registerScript($latinScript);
        $wordCounterResponse = $wordCounter->process('Amazing text 123', true);

        self::assertEquals(3, $wordCounterResponse->getCount());
        self::assertEquals(['Amazing', 'text', '123'], $wordCounterResponse->getWords()->toArray());

        /** @var ScriptInterface|Mockery\MockInterface $overwrittenScript */
        $overwrittenScript = Mockery::mock($latinScript);
        $overwrittenScript->expects('getCharacterCollection')->once()->andReturn(new CharacterCollection(['1']));
        $overwrittenScript->expects('getName')->once()->andReturn($latinScript->getName());

        $wordCounter->registerScript($overwrittenScript, true);
        $wordCounterResponse = $wordCounter->process('Amazing text 123', true);

        self::assertEquals(1, $wordCounterResponse->getCount());
        self::assertEquals(['1'], $wordCounterResponse->getWords()->toArray());
    }

    public function testCanRegisterJoiners(): void {
        $wordCounter = new WordCounter();
        $wordCounter->registerScript(new LatinScript());

        $wordCounterResponse = $wordCounter->process('It\'s amazing text', true);

        self::assertEquals(4, $wordCounterResponse->getCount());
        self::assertEquals(['It', 's', 'amazing', 'text'], $wordCounterResponse->getWords()->toArray());

        $wordCounter->registerJoiners(new CharacterCollection(['\'']));
        $wordCounterResponse = $wordCounter->process('It\'s amazing text', true);

        self::assertEquals(3, $wordCounterResponse->getCount());
        self::assertEquals(['It\'s', 'amazing', 'text'], $wordCounterResponse->getWords()->toArray());
    }

    public function testCanRegisterJoinersWithOverwrite(): void {
        $wordCounter = WordCounter::buildWithDefaults();
        $wordCounter->registerJoiners(new CharacterCollection(['\'']), true);
        $wordCounterResponse = $wordCounter->process('It\'s amazing text', true);

        self::assertEquals(3, $wordCounterResponse->getCount());
        self::assertEquals(['It\'s', 'amazing', 'text'], $wordCounterResponse->getWords()->toArray());

        $wordCounter->registerJoiners(new CharacterCollection([]), true);
        $wordCounterResponse = $wordCounter->process('It\'s amazing text', true);

        self::assertEquals(4, $wordCounterResponse->getCount());
        self::assertEquals(['It', 's', 'amazing', 'text'], $wordCounterResponse->getWords()->toArray());
    }

}