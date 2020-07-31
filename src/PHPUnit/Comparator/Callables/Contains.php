<?php

namespace Ascaura\PHPUnit\Comparator\Callables;

use \SebastianBergmann\Comparator\ComparisonFailure;

class Contains extends BaseCallable
{
    private $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    public function isValid($actual)
    {
        $isValid = strpos($actual, $this->payload);

        if ($isValid !== false) {
            return $this->isValid = true;
        }

        throw new ComparisonFailure(
            (string)$this,
            $actual,
            '',
            '',
            false,
            sprintf('Failed asserting that \'%s\' is a password hash for \'%s\'', $actual, $this->payload)
        );
    }
}
