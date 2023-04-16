<?php

declare(strict_types=1);

namespace WordCounter\Helper;

use WordCounter\Script\ArabicScript;

class ScriptRegistry {

    public static function getAllScripts(): array {
        return [
            new ArabicScript(),
        ];
    }

}