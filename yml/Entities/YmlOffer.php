<?php

/**
 * Created by PhpStorm.
 * User: stass
 * Date: 12/5/2016
 * Time: 5:42 PM
 */
class YmlOffer
{
    private $id;
    private $available="true";
    private $price;
    private $url;
    private $currencyId;
    private $categorId;
    private $pictures=array();
    private $store="false";
    private $delivery;
    private $name;
    private $vendor;
    private $model;
    private $description;
    private $salesNotes;
    private $barcode;
    private $age;
    private $params=array();
    public function __construct($id)
    {
        if($id==null || $id=="")
        {
            throw new InvalidArgumentException("Empty offer id");
        }
        $this->id=$id;
    }
    public function changeAvaliableStatus()
    {
        if($this->available=="true")
        {
            $this->available="false";

        }
        else
        {
            $this->available="false";
        }
    }
    public function getAvailableStatus()
    {
        return $this->available;
    }
    public function setOfferPrice($price)
    {
        if(!preg_match("/[0-9]+\.[0-9]+/",$price))
        {
            throw new InvalidArgumentException("invalid offer price value");
        }
        $this->price=$price;
    }
    public function setCureency(YmlCurrency $currency)
    {
        $this->currencyId=$currency->getCurrencyId();
    }
    public function setCategoryId(YmlCategory $category)
    {
        $this->categorId=$category->getCategoryid();
    }
    public function addPicture($pictureUrl)
    {
        if($pictureUrl=="")
        {
            throw new InvalidArgumentException("Empty picture url");
        }
        if(in_array($pictureUrl,$this->pictures))
        {
            throw new InvalidArgumentException("Url already exists");
        }
        $this->pictures[]=$pictureUrl;
    }
    

}