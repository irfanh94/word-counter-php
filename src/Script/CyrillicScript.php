<?php

declare(strict_types=1);

namespace WordCounter\Script;

use WordCounter\CharacterCollection;
use WordCounter\Contract\ScriptInterface;

class CyrillicScript implements ScriptInterface {

    private CharacterCollection $characterCollection;

    public function __construct() {
        $this->characterCollection = new CharacterCollection();
        $this->characterCollection->add([
            'А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Ђ', 'ђ', 'Е', 'е', 'Ё', 'ё',
            'Ж', 'ж', 'З', 'з', 'И', 'и', 'Й', 'й', 'К', 'к', 'Л', 'л', 'Љ', 'љ', 'М', 'м',
            'Н', 'н', 'Њ', 'њ', 'О', 'о', 'П', 'п', 'Р', 'р', 'С', 'с', 'Т', 'т', 'Ћ', 'ћ',
            'У', 'у', 'Ф', 'ф', 'Х', 'х', 'Ц', 'ц', 'Ч', 'ч', 'Џ', 'џ', 'Ш', 'ш', 'Ґ', 'ґ',
            'Ў', 'ў', 'Щ', 'щ', 'Ъ', 'ъ', 'Ь', 'ь', 'Ђ', 'ђ', 'Ћ', 'ћ', 'Џ', 'џ', 'Ы', 'ы',
            'Э', 'э', 'Ю', 'ю', 'Я', 'я', 'І', 'і', 'Ї', 'ї', 'Є', 'є', 'Ѓ', 'ѓ', 'Ќ', 'ќ',
            'Ә', 'ә', 'Ҡ', 'ҡ', 'Ӄ', 'ӄ', 'Ө', 'ө', 'Ү', 'ү', 'Ӕ', 'ӕ', 'Ӣ', 'ӣ', 'Ӯ', 'ӯ',
            'ҧ',
        ]);
    }

    public function getCharacterCollection(): CharacterCollection {
        return $this->characterCollection;
    }

}