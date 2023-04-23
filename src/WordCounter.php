<?php

declare(strict_types=1);

namespace WordCounter;

use RuntimeException;
use WordCounter\Collection\CharacterCollection;
use WordCounter\Collection\Word;
use WordCounter\Collection\WordCollection;
use WordCounter\Contract\ScriptInterface;
use WordCounter\Helper\CharacterJoiners;
use WordCounter\Helper\ScriptRegistry;
use WordCounter\Iterator\CharacterIterator;

final class WordCounter {

    private array $supportedCharacterMap = [];
    private array $supportedJoinerMap = [];

    public function process(string $text, bool $exportWords = false): WordCounterResult {
        $wordCount = 0;
        $wordList = new WordCollection();

        $temporaryCharacters = '';
        $temporaryCharacterCount = 0;

        $characterIterator = new CharacterIterator($text);
        $characterIterator->iterate(
            function (?string $previousCharacter, string $currentCharacter, ?string $nextCharacter)
            use (&$temporaryCharacters, &$temporaryCharacterCount, &$wordCount, &$wordList, $exportWords): void {
                if (!$this->isCharacterMatch($previousCharacter, $currentCharacter, $nextCharacter)) {
                    if (!empty($temporaryCharacters)) {
                        self::saveWord($wordCount, $wordList, $temporaryCharacters, $temporaryCharacterCount, $exportWords);
                    }
                    return;
                }

                $temporaryCharacters .= $currentCharacter;
                $temporaryCharacterCount++;
            }
        );

        if (!empty($temporaryCharacters)) {
            self::saveWord($wordCount, $wordList, $temporaryCharacters, $temporaryCharacterCount, $exportWords);
        }


        return new WordCounterResult($wordCount, $wordList);
    }

    public function registerJoiners(CharacterCollection $characterCollection, bool $overwrite = false): self {
        if ($overwrite) {
            $this->supportedJoinerMap = [];
        }

        foreach ($characterCollection->get() as $character) {
            $this->supportedJoinerMap[$character] = 1;
        }

        return $this;
    }

    public function registerScript(ScriptInterface $script, bool $overwrite = false): self {
        $characters = $script->getCharacterCollection()->get();

        if ($overwrite) {
            $this->removeScript($script);
        }

        foreach ($characters as $character) {
            if (isset($this->supportedCharacterMap[$character])) {
                throw new RuntimeException("Character \"{$character}\" (x". bin2hex($character) .") already registered in: ". get_class($this->supportedCharacterMap[$character]));
            }

            $this->supportedCharacterMap[$character] = $script;
        }

        return $this;
    }

    public function removeScript(ScriptInterface $script): self {
        foreach ($this->supportedCharacterMap as $supportedCharacter => $supportedScript) {
            if ($supportedScript->getName() === $script->getName()) {
                unset($this->supportedCharacterMap[$supportedCharacter]);
            }
        }

        return $this;
    }

    private function isCharacterMatch(
        ?string $previousCharacter,
        string $currentCharacter,
        ?string $nextCharacter
    ): bool {
        if (isset($this->supportedCharacterMap[$currentCharacter])) {
            return true;
        }

        return isset(
            $this->supportedCharacterMap[$previousCharacter],
            $this->supportedCharacterMap[$nextCharacter],
            $this->supportedJoinerMap[$currentCharacter]
        );
    }

    public static function buildWithDefaults(): WordCounter {
        $wordCounter = new self();
        $wordCounter->registerJoiners((new CharacterJoiners())->getCharacterCollection());

        $supportedScripts = ScriptRegistry::getAllScripts();
        foreach ($supportedScripts as $supportedScript) {
            $wordCounter->registerScript($supportedScript);
        }

        return $wordCounter;
    }

    private static function saveWord(int &$wordCount, WordCollection $wordCollection, string &$characters, int &$characterCount, bool $exportWords): void {
        $wordCount++;

        if ($exportWords) {
            $wordCollection->add(new Word($characters, $characterCount));
        }

        $characters = '';
        $characterCount = 0;
    }
}