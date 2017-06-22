<?php

namespace Ascaura\PHPUnit\Exporter;

use Ascaura\PHPUnit\CallableComparatorTrait;
use SebastianBergmann\Comparator\Factory;

class CallableComparatorTraitTest extends \PHPUnit_Framework_TestCase
{
    use CallableComparatorTrait;

    public function setUp()
    {
        $this->setupCallableComparator();
    }

    public function tearDown()
    {
        $this->tearDownCallableComparator();
    }

    public function testArrayComparator()
    {
        $comparatorFactory = Factory::getInstance();
        $comparator = $comparatorFactory->getComparatorFor([], []);

        $this->assertInstanceOf('\Ascaura\PHPUnit\Comparator\ArrayComparator', $comparator);
    }

    public function testCallableComparator()
    {
        $callableComparatorMock = $this
            ->getMockBuilder('\Ascaura\PHPUnit\Comparator\Callables\CallableInterface')
            ->getMock();

        $comparatorFactory = Factory::getInstance();
        $comparator = $comparatorFactory->getComparatorFor($callableComparatorMock, null);

        $this->assertInstanceOf('\Ascaura\PHPUnit\Comparator\CallableComparator', $comparator);
    }
}
