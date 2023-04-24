<?php

declare(strict_types=1);

namespace WordCounter\Helper;

use PHPUnit\Framework\TestCase;
use WordCounter\Script\ArabicScript;
use WordCounter\Script\CyrillicScript;
use WordCounter\Script\LatinScript;

class ScriptRegistryTest extends TestCase {

    public function testCanMatchScriptsFromRegistry(): void {
        self::assertEquals([
            new LatinScript(),
            new ArabicScript(),
            new CyrillicScript(),
        ], ScriptRegistry::getAllScripts());
    }

}