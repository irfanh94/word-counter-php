<?php

declare(strict_types=1);

namespace WordCounter\Script;

use WordCounter\Collection\CharacterCollection;
use WordCounter\Contract\ScriptInterface;

class LatinScript implements ScriptInterface {

    private CharacterCollection $characterCollection;

    public function __construct() {
        $this->characterCollection = new CharacterCollection([
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
            'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ',
            'à', 'á', 'â', 'ã', 'ä', 'å', 'æ',
            'ß',
            'Ç', 'Ć', 'Č',
            'ç', 'ć', 'č',
            'Đ', 'đ',
            'È', 'É', 'Ê', 'Ë', 'Ę',
            'è', 'é', 'ê', 'ë', 'ę',
            'Ğ', 'ğ',
            'Ħ', 'ħ',
            'Ì', 'Í', 'Î', 'Ï', 'İ',
            'ì', 'í', 'î', 'ï', 'i',
            'Ĵ', 'ĵ',
            'Ł', 'ł',
            'Ñ', 'Ń', 'Ņ', 'Ň',
            'ñ', 'ń', 'ņ', 'ň',
            'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ő',
            'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ő',
            'Œ', 'œ',
            'Ŕ', 'Ř',
            'ŕ', 'ř',
            'Ś', 'Ŝ', 'Ş', 'Š',
            'ś', 'ŝ', 'ş', 'š',
            'Þ', 'þ',
            'Ù', 'Ú', 'Û', 'Ü', 'Ű', 'Ų',
            'ù', 'ú', 'û', 'ü', 'ű', 'ų',
            'Ŵ', 'ŵ',
            'Ý', 'Ÿ',
            'ý', 'ÿ',
            'Ź', 'Ż', 'Ž',
            'ź', 'ż', 'ž',
        ]);
    }

    public function getName(): string {
        return 'Latin';
    }

    public function getCharacterCollection(): CharacterCollection {
        return $this->characterCollection;
    }

}