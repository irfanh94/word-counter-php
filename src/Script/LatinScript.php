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
            ->addRange(0xc0, 0xc6) // À, Á, Â, Ã, Ä, Å, Æ
            ->addRange(0xe0, 0xe6) // à, á, â, ã, ä, å, æ
            ->add(0xdf) // ß
            ->addList([0xc7, 0x0106, 0x010c]) // Ç, Ć, Č
            ->addList([0xe7, 0x0107, 0x010d]) // ç, ć, č
            ->addList([0x0110, 0x0111]) // Đ, đ
            ->addList([0xc8, 0xc9, 0xca, 0xcb, 0x0118]) // È, É, Ê, Ë, Ę
            ->addList([0xe8, 0xe9, 0xea, 0xeb, 0x0119]) // è, é, ê, ë, ę
            ->addList([0x011e, 0x011f]) // Ğ, ğ
            ->addList([0x0126, 0x0127]) // Ħ, ħ
            ->addList([0xcc, 0xcd, 0xce, 0xcf, 0x0130]) // Ì, Í, Î, Ï, İ
            ->addList([0xec, 0xed, 0xee, 0xef, 0x0307]) // ì, í, î, ï, i̇
            ->addList([0x0134, 0x0135]) // Ĵ, ĵ
            ->addList([0x0141, 0x0142]) // Ł, ł
            ->addList([0xd1, 0x0143, 0x0145, 0x0147]) // Ñ, Ń, Ņ, Ň
            ->addList([0xf1, 0x0144, 0x0146, 0x0148]) // ñ, ń, ņ, ň
            ->addList([0xd2, 0xd3, 0xd4, 0xd5, 0xd6, 0xd8, 0x0150]) // Ò, Ó, Ô, Õ, Ö, Ø, Ő
            ->addList([0xf2, 0xf3, 0xf4, 0xf5, 0xf6, 0xf8, 0x0151]) // ò, ó, ô, õ, ö, ø, ő
            ->addList([0x0152, 0x0153]) // Œ, œ
            ->addList([0x0154, 0x0158]) // Ŕ, Ř
            ->addList([0x0155, 0x0159]) // ŕ, ř
            ->addList([0x015a, 0x015c, 0x015e, 0x0160]) // Ś, Ŝ, Ş, Š
            ->addList([0x015b, 0x015d, 0x015f, 0x0161]) // ś, ŝ, ş, š
            ->addList([0xde, 0xfe]) // Þ, þ
            ->addList([0xd9, 0xda, 0xdb, 0xdc, 0x0170, 0x0172]) // Ù, Ú, Û, Ü, Ű, Ų
            ->addList([0xf9, 0xfa, 0xfb, 0xfc, 0x0171, 0x0173]) // ù, ú, û, ü, ű, ų
            ->addList([0x0174, 0x0175]) // Ŵ, ŵ
            ->addList([0xdd, 0x0178]) // Ý, Ÿ
            ->addList([0xfd, 0xff]) // ý, ÿ
            ->addList([0x0179, 0x017b, 0x017d]) // Ź, Ż, Ž
            ->addList([0x017a, 0x017c, 0x017e]); // ź, ż, ž

        return $collection;
    }

}