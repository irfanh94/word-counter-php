<?php

declare(strict_types=1);

namespace WordCounter\Helper;

use WordCounter\Script\ArabicScript;
use WordCounter\Script\CyrillicScript;
use WordCounter\Script\LatinScript;

class ScriptRegistry {

    public static function getAllScripts(): array {
        return [
            new LatinScript(),
            new ArabicScript(),
            new CyrillicScript(),
        ];
    }

}