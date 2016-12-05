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
        $this->name=$name;
        $this->value=$value;
        $this->unit=$unit;

    }
    public  function Equal(YmlOfferParameter $parameter)
    {
        return $this->name==$parameter->name && $this->value==$parameter->value && $this->unit==$parameter->unit;
    }
    public function generate()
    {
        $str="<param name=\"".$this->name."\"";
        if($this->unit!="")
        {
            $str.=" unit=\"".$this->unit."\"";
        }
        $str.=">".$this->value."</param>";
        return $str;
    }
}