<?php

declare(strict_types=1);

namespace WordCounter\Helper;

final class NonPrintableCharacters {

    public const ZWJ = 0x200c; // Separate characters that would otherwise be joined together in certain languages.
    public const ZWSP = 0x200b; // Create a space between characters that should not be joined together
    public const NBSP = 0xa0; // Create a space that cannot be broken by line breaks or word wrapping
    public const LRM = 0x200e; // Indicate that text should be read from left to right
    public const RLM = 0x200f; // Indicate that text should be read from right to left

}