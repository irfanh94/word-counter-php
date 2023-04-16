<?php

declare(strict_types=1);

namespace WordCounter\Helper;

use WordCounter\Language\ArabicLanguage;
use WordCounter\Language\AssameseLanguage;
use WordCounter\Language\EnglishLanguage;

class LanguageRegistry {

    public static function getAllLanguages(): array {
        return [
            new ArabicLanguage(),
            new AssameseLanguage(),
            new EnglishLanguage(),
        ];
    }

}