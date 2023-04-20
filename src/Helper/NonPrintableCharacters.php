<?php

declare(strict_types=1);

namespace WordCounter\Helper;

final class NonPrintableCharacters {

    public const ZWJ = "\u{200c}"; // Separate characters that would otherwise be joined together in certain languages.
    public const ZWSP = "\u{200b}"; // Create a space between characters that should not be joined together
    public const NBSP = "\u{a0}"; // Create a space that cannot be broken by line breaks or word wrapping
    public const LRM = "\u{200e}"; // Indicate that text should be read from left to right
    public const RLM = "\u{200f}"; // Indicate that text should be read from right to left

}