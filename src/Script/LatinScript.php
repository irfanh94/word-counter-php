<?php

declare(strict_types=1);

namespace WordCounter\Script;

use WordCounter\CharacterUnicodeCollection;
use WordCounter\Contract\ScriptInterface;

class LatinScript implements ScriptInterface {

    public function getCharacterUnicodeCollection(): CharacterUnicodeCollection {
        $collection = new CharacterUnicodeCollection();
        $collection
            ->addRange(0x30, 0x39) // 0, 1, 2, 3, 4, 5, 6, 7, 8, 9
            ->addRange(0x41, 0x5a) // A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X, Y, Z
            ->addRange(0x61, 0x7a) // a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z
            ->addRange(0xc380, 0xc386) // À, Á, Â, Ã, Ä, Å, Æ
            ->addRange(0xc3a0, 0xc3a6) // à, á, â, ã, ä, å, æ
            ->add(0xc39f) // ß
            ->addList([0xc387, 0xc486, 0xc48c]) // Ç, Ć, Č
            ->addList([0xc3a7, 0xc487, 0xc48d]) // ç, ć, č
            ->addList([0xc490, 0xc491]) // Đ, đ
            ->addList([0xc388, 0xc389, 0xc38a, 0xc38b, 0xc498]) // È, É, Ê, Ë, Ę
            ->addList([0xc3a8, 0xc3a9, 0xc3aa, 0xc3ab, 0xc499]) // è, é, ê, ë, ę
            ->addList([0xc49e, 0xc49f]) // Ğ, ğ
            ->addList([0xc4a6, 0xc4a7]) // Ħ, ħ
            ->addList([0xc38c, 0xc38d, 0xc38e, 0xc38f, 0xc4b0]) // Ì, Í, Î, Ï, İ
            ->addList([0xc3ac, 0xc3ad, 0xc3ae, 0xc3af, 0x69cc87]) // ì, í, î, ï, i̇
            ->addList([0xc4b4, 0xc4b5]) // Ĵ, ĵ
            ->addList([0xc581, 0xc582]) // Ł, ł
            ->addList([0xc391, 0xc583, 0xc585, 0xc587]) // Ñ, Ń, Ņ, Ň
            ->addList([0xc3b1, 0xc584, 0xc586, 0xc588]) // ñ, ń, ņ, ň
            ->addList([0xc392, 0xc393, 0xc394, 0xc395, 0xc396, 0xc398, 0xc590]) // Ò, Ó, Ô, Õ, Ö, Ø, Ő
            ->addList([0xc3b2, 0xc3b3, 0xc3b4, 0xc3b5, 0xc3b6, 0xc3b8, 0xc591]) // ò, ó, ô, õ, ö, ø, ő
            ->addList([0xc592, 0xc593]) // Œ, œ
            ->addList([0xc594, 0xc598]) // Ŕ, Ř
            ->addList([0xc595, 0xc599]) // ŕ, ř
            ->addList([0xc59a, 0xc59c, 0xc59e, 0xc5a0]) // Ś, Ŝ, Ş, Š
            ->addList([0xc59b, 0xc59d, 0xc59f, 0xc5a1]) // ś, ŝ, ş, š
            ->addList([0xc39e, 0xc3be]) // Þ, þ
            ->addList([0xc399, 0xc39a, 0xc39b, 0xc39c, 0xc5b0, 0xc5b2]) // Ù, Ú, Û, Ü, Ű, Ų
            ->addList([0xc3b9, 0xc3ba, 0xc3bb, 0xc3bc, 0xc5b1, 0xc5b3]) // ù, ú, û, ü, ű, ų
            ->addList([0xc5b4, 0xc5b5]) // Ŵ, ŵ
            ->addList([0xc39d, 0xc5b8]) // Ý, Ÿ
            ->addList([0xc3bd, 0xc3bf]) // ý, ÿ
            ->addList([0xc5b9, 0xc5bb, 0xc5bd]) // Ź, Ż, Ž
            ->addList([0xc5ba, 0xc5bc, 0xc5be]); // ź, ż, ž

        return $collection;
    }

}