<?php

/**
 * Created by PhpStorm.
 * User: stass
 * Date: 12/5/2016
 * Time: 5:03 PM
 */
class YmlCurrency
{
    private $id="";
    private $rate="";
    public function __construct($id,$rate)
    {
        if($id=="" || $id==null)
        {
            throw  new InvalidArgumentException("Empty currency id");
        }
        if($rate=="" || $rate==null)
        {
            throw  new InvalidArgumentException("Empty currency rate");
        }
        $this->id=$id;
        $this->rate=$rate;
    }
    public  function generate()
    {
        return "<currency id=\"".$this->id."\" rate=\"".$this->rate."\"/>";
    }
    public  function Equal(YmlCurrency $currency)
    {
        return $this->id==$currency->id && $this->rate==$currency->rate;
    }
}