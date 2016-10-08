<?php
/**
 * Created by PhpStorm.
 * User: Marek
 * Date: 2016-10-07
 * Time: 18:07
 */

namespace AppBundle\Services;


class Losujemy
{
    private $parameter;

    function __construct($parameter)
    {
        $this->parameter = $parameter;
    }


    public function getLiczba()
    {
        return rand(1000, 9999) . " {$this->getCycki()}";
    }

    public function getCycki()
    {
        return $this->parameter;
    }
}