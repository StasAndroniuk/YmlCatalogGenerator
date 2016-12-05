<?php

/**
 * Created by PhpStorm.
 * User: stass
 * Date: 12/5/2016
 * Time: 4:50 PM
 */
class YmlShop
{
    private $name;
    private $company;
    private $url;
    private $currencies=array();
    private $categories=array();
    private $offers=array();
    public  function setShopName($name)
    {
        if($name=="" || $name==null)
        {
            throw new InvalidArgumentException("Empty name");
        }
        $this->name=$name;
    }
    public  function setShopCompany($company)
    {
        if($company=="" || $company==null)
        {
            throw new InvalidArgumentException("Empty company name");
        }
        $this->company=$company;
    }
    public function setShopUrl($url)
    {
        if($url=="" || $url==null)
        {
            throw new InvalidArgumentException("Empty url");
        }
        $this->url=$url;
    }

}