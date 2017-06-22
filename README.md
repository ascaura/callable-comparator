# PHPUnit Callable Comparator

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.txt)
[![Build Status](https://travis-ci.org/ascaura/callable-comparator.svg?branch=master)](https://travis-ci.org/ascaura/callable-comparator)
[![Code Climate](https://codeclimate.com/github/ascaura/callable-comparator/badges/gpa.svg)](https://codeclimate.com/github/ascaura/callable-comparator)
[![Test Coverage](https://codeclimate.com/github/ascaura/callable-comparator/badges/coverage.svg)](https://codeclimate.com/github/ascaura/callable-comparator)
[![Total Downloads](https://img.shields.io/packagist/dt/ascaura/callable-comparator.svg)](https://packagist.org/packages/ascaura/callable-comparator)

Makes it possible to use callables in PHPunit assertions

## Installation
```sh
composer require ascaura/callable-comparator
```

## Usage
```php
<?php

require_once ('vendor/autoload.php');

use Ascaura\PHPUnit\CallableComparatorTrait;
use Ascaura\PHPUnit\Comparator\Callables\CallableProxy;
use Ascaura\PHPUnit\Comparator\Callables\IsDateTime;
use Ascaura\PHPUnit\Comparator\Callables\IsUuid;
use Ascaura\PHPUnit\Comparator\Callables\IsPasswordHashFor;

class ExampleTest extends \PHPUnit_Framework_TestCase
{
    use CallableComparatorTrait;

    public function setUp()
    {
        parent::setUp();
        $this->setupCallableComparator();
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->tearDownCallableComparator();
    }

    public function testCallableComparator()
    {
        $data = [
            'id' => 'f4a2b7b0-e944-11e4-b571-0800200c9a66',
            'modified' => '2015-03-22 01:12',
            'bcrypt_password' => password_hash('password', PASSWORD_BCRYPT),
            'default_password' => password_hash('password', PASSWORD_DEFAULT),
            'emptystring' => '',
            'contains' => 'This string contains "lazy fox".'
        ];

        $expected = [
            'id' => new IsUuid(),
            'modified' => new IsDateTime(),
            'bcrypt_password' => new IsPasswordHashFor('password'),
            'default_password' => new IsPasswordHashFor('password'),
            'emptystring' => new CallableProxy([$this, 'assertEmpty']),
            'contains' => new CallableProxy([$this, 'assertContains'], ['lazy fox'])
        ];

        $this->assertEquals($expected, $data);
    }
}
```
