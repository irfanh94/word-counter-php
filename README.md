## About
Introducing our new PHP word-count package, a powerful tool for accurately counting the number of words in any text input. This package currently supports 3 language scripts and is highly customizable, allowing for exclusion of certain words or phrases from the count and options for case sensitivity and stemming.

## Supported scripts
 - Latin
 - Arabic
 - Cyrillic


## Installation & usage with composer

Install the package:
```
composer require irfanh94/word-counter-php
```

Using WordCounter to only count:

```php
<?php

$wordCounter = WordCounter\WordCounter::buildWithDefaults();

$numberOfWords = $wordCounter
    ->process("This is amazing")
    ->getCount(); // response: 3
```

Using WordCounter to also output list of detected words:

```php
<?php

$wordCounter = WordCounter\WordCounter::buildWithDefaults();
$wordCounterResponse = $wordCounter->process("This is amazing", true);

$numberOfWords = $wordCounterResponse->getCount();
$listOfWords = $wordCounterResponse->getWords();
```

## Benchmark for 10k words (67kb)
| bench class      | bench method                | memory peak | average time |
|------------------|-----------------------------|-------------|--------------|
| WordCounterBench | benchCounter                | 1,653,792b  | 15,787.200μs |
| WordCounterBench | benchCounterWithWordsExport | 3,021,840b  | 16,966.440μs |