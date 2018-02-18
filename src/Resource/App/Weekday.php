<?php
namespace MyVendor\MyProject\Resource\App;

use BEAR\Resource\ResourceObject;

class Weekday extends ResourceObject
{
    public function onGet(int $year, int $month, int $day) : ResourceObject
    {
        $date = \DateTime::createFromFormat('Y-m-d', "$year-$month-$day");
        $this->body = [
            'weekday' => $date->format('D')
        ];

        return $this;
    }
}
