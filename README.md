# PHP typed list

[![Build Status](https://travis-ci.org/jakub-frajt/typed-list.svg?branch=master)](https://travis-ci.org/jakub-frajt/typed-list)

## Integer list
```php
use Frajt\IntegerList;

// create IntegerList from array
$integerList = new IntegerList([1, 2, 30]);

// numeric string values are automatically casted to integer
$integerList = new IntegerList(['1', 2, 30]);

$integerList->getValues(); // get values as array [1, 2, 30]

// support \Iterator interface
foreach ($integerList as $intValue) {
    echo $intValue.PHP_EOL;
}
```
