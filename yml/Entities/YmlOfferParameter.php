<?php

/**
 * Created by PhpStorm.
 * User: stass
 * Date: 12/5/2016
 * Time: 5:48 PM
 */
class YmlOfferParameter
{
    private $name;
    private $unit;
    private $value;
    public function __construct($name,$value,$unit="")
    {
        if($name===null ||$name="")
        {
            throw new InvalidArgumentException("Empty parameter name");
        }
    }
}