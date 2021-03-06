<?php

namespace Ascaura\PHPUnit;

use Ascaura\PHPUnit\Comparator\ArrayComparator;
use Ascaura\PHPUnit\Comparator\CallableComparator;
use SebastianBergmann\Comparator\Factory;

trait CallableComparatorTrait
{
    private $comparatorFactory;
    private $comparators = [];

    public function setupCallableComparator()
    {
        $this->comparatorFactory = Factory::getInstance();
        $this->comparators[] = new ArrayComparator();
        $this->comparators[] = new CallableComparator();

        foreach ($this->comparators as $comparator) {
            $this->comparatorFactory->register($comparator);
        }
    }

    public function tearDownCallableComparator()
    {
        if (is_null($this->comparatorFactory)) {
            return;
        }

        foreach ($this->comparators as $comparator) {
            $this->comparatorFactory->unregister($comparator);
        }
    }
}
