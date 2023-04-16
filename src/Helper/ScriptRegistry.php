<?php

declare(strict_types=1);

namespace WordCounter\Helper;

use WordCounter\Script\LatinScript;

class ScriptRegistry {

    public static function getAllScripts(): array {
        return [
            new LatinScript(),
        ];
    }

}