<?php

namespace BerryGoudswaard\PHPUnit\Exporter;

use BerryGoudswaard\PHPUnit\Comparator\Callables\BaseCallable;
use SebastianBergmann\Exporter\Exporter as BaseExporter;

class Exporter extends BaseExporter
{
    public function shortenedExport($value)
    {
        if ($value instanceof BaseCallable) {
            return (string)$value;
        }

        return parent::shortenedExport($value);
    }
}
