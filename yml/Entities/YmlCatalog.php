<?php

/**
 * Created by PhpStorm.
 * User: stass
 * Date: 12/5/2016
 * Time: 4:49 PM
 */
class YmlCatalog
{
    private $shop;
    public  function __construct()
    {
        $this->shop=new YmlShop();
    }
}