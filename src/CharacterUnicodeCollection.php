<?php

declare(strict_types=1);

namespace WordCounter;

use function in_array;

class CharacterUnicodeCollection {

    private array $list = [];

    public function addRange(int $from, int $to): self {
        for ($unicode = $from; $unicode <= $to; $unicode++) {
            $this->add($unicode);
        }

        return $this;
    }

    public function addList(array $unicodeList): self {
        foreach ($unicodeList as $unicode) {
            $this->add((int) $unicode);
        }

        return $this;
    }

    public function add(int $unicode): self {
        if (!in_array($unicode, $this->list, true)) {
            $this->list[] = $unicode;
        }

        return $this;
    }

    public function getList(): array {
        return $this->list;
    }

}