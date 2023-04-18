## About
Introducing our new PHP word-count package, a powerful tool for accurately counting the number of words in any text input. This package currently supports 2 language scripts and is highly customizable, allowing for exclusion of certain words or phrases from the count and options for case sensitivity and stemming.

## Supported scripts
 - Latin
 - Arabic


## Installation & usage with composer

Install the package:
```
composer require irfanh94/word-counter-php
```

Using WordCounter to only count:

```php
<?php

$wordCounter = new WordCounter\WordCounter();
$wordCounter->registerAllScriptsFromRegistry();

$numberOfWords = $wordCounter
    ->process("This is amazing")
    ->getCount();
```

Using WordCounter to also output list of detected words:
```php
<?php

$wordCounter = new WordCounter\WordCounter();
$wordCounter->registerAllScriptsFromRegistry();

$wordCounterResponse = $wordCounter->process("This is amazing", true);

$numberOfWords = $wordCounterResponse->getCount();
$listOfWords = $wordCounterResponse->getWords();
```