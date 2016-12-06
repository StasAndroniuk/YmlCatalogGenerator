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
    private $type;
    private $available="true";
    private $price;
    private $oldPrice;
    private $url;
    private $currencyId;
    private $categorId;
    private $pictures=array();
    private $store="false";
    private $delivery="true";
    private $name;
    private $vendor;
    private $model;
    private $description;
    private $salesNotes;
    private $barcode;
    private $age;
    private $params=array();
    public function __construct($id,$type="vendor.model")
    {
        if($id==null || $id=="")
        {
            throw new InvalidArgumentException("Empty offer id");
        }
        if($type==null || $type=="")
        {
            throw new InvalidArgumentException("Empty offer type");
        }
        $this->id=$id;
        $this->type=$type;
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
    public function getofferType()
    {
        return $this->type;
    }
    public function getStoreType()
    {
        return $this->store;
    }
    public function setOfferPrice($price)
    {
        if(!preg_match("/[0-9]+\.[0-9]+/",$price))
        {
            throw new InvalidArgumentException("invalid offer price value");
        }
        $this->price=$price;
    }
    public function setOldPrice($oldPrice)
    {
        if($oldPrice==null)
        {
            throw new InvalidArgumentException("Empty offer old price");
        }
        $this->oldPrice=$oldPrice;
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
    public function setOfferUrl($url)
    {
        if($url=="")
        {
            throw new InvalidArgumentException("Empty offer url");
        }
        $this->url=$url;
    }
    public function changeStoreType()
    {
        if($this->store=="true")
        {
            $this->store="fasle";
        }
        else
        {
            $this->store="true";
        }
    }
    public function changeDeliveryStatus()
    {
        if($this->delivery=="true")
        {
            $this->delivery="false";
        }
        else
        {
            $this->delivery="true";
        }
    }
    public function setofferName($name)
    {
        if($name==null || $name=="")
        {
            throw new InvalidArgumentException("Empty offer name");
        }
        $this->name=$name;
    }
    public function setOfferVendor($vendor)
    {
        if($vendor==null)
        {
            throw  new InvalidArgumentException('Empty offer vendor');
        }
        $this->vendor=$vendor;
    }
    public function setOfferModel($model)
    {
        if($model==null)
        {
            throw  new InvalidArgumentException("Empty offer model");
        }
        $this->model=$model;
    }
    public function setOfferDescription($description)
    {
        if($description==null)
        {
            throw new InvalidArgumentException("Empty offer description");
        }
        $this->description=$description;
    }
    public function setSalesNotes($salesNotes)
    {
        if($salesNotes==null)
        {
            throw new InvalidArgumentException("Empty offer sales notes");
        }
        $this->salesNotes=$salesNotes;
    }
    public function setOfferBarcode($code)
    {
        if($code==null)
        {
            throw new InvalidArgumentException("Empty offer barcode");
        }
        $this->barcode=$code;
    }
    public function setOfferAge($age)
    {
        if($age==null)
        {
            throw new InvalidArgumentException("Empty offer age");
        }
        $this->age=$age;
    }
    public function addOfferParam(YmlOfferParameter $param)
    {
        foreach ($this->params as $p)
        {
            if($param->Equal($p))
            {
                throw new InvalidArgumentException("Offer parameter already exists");
            }
        }
        $this->params[]=$param;
    }
    public function setOfferType($type)
    {
        if($type=="")
        {
            throw new InvalidArgumentException("Empty offer type");
        }
        $this->type=$type;
    }
    public function generate()
    {
        if($this->validateOffer())
        {
            $offer="<offer id=\"".$this->id."\" type=\"".$this->type."\" available=\"".$this->available."\">";
            $offer.="<model>".$this->model."</model>";
            $offer.="<vendor>".$this->vendor."</vendor>";
            $offer.="<url>".$this->url."</url>";
            $offer.="<price>".$this->price."</price>";
            $offer.="<currencyId>".$this->currencyId."</currencyId>";
            $offer.="<categoryId>".$this->categorId."</categoryId>";
            $offer.="<name>".$this->name."</name>";
            $offer.="<store>".$this->store."</store>";
            $offer.="<delivery>".$this->delivery."</delivery>";
            foreach ($this->pictures as $pic)
            {
                $offer.="<picture>".$pic."</picture>";
            }
            if($this->description!="")
            {
                $offer.="<description>".$this->description."</description>";
            }
            if($this->oldPrice!="")
            {
                $offer.="<oldprice>".$this->oldPrice."</oldprice>";
            }
            if($this->age!="")
            {
                $offer.="<age>".$this->age."</age>";
            }
            if($this->salesNotes!="")
            {
                $offer.="<sales_notes>".$this->salesNotes."</sales_notes>";
            }
            if($this->barcode!="")
            {
                $offer.="<barcode>".$this->barcode."</barcode>";
            }
            if(count($this->params)>0)
            {
                foreach ($this->params as $param)
                {
                    $offer.=$param->generate();
                }
            }
            $offer.="</offer>";
            return $offer;
        }
    }
    private function validateOffer()
    {
        if($this->type=="")
        {
            throw new InvalidArgumentException("invalid offer type");
        }
        if($this->model=="")
        {
            throw new InvalidArgumentException("Invalid offer model");
        }
        if($this->vendor=="")
        {
            throw new InvalidArgumentException("Invalid offer vendor");
        }
        if($this->url=="")
        {
            throw new InvalidArgumentException("Invalid offer url");
        }
        if($this->price=="")
        {
            throw new InvalidArgumentException("Invalid offer price");
        }
        if($this->currencyId=="")
        {
            throw new InvalidArgumentException("Invalid offer currency id");
        }
        if($this->categorId=="")
        {
            throw new InvalidArgumentException("Invalid offer category");
        }
        if(count($this->pictures)==0)
        {
            throw new InvalidArgumentException("Offer doesn't have pictures");
        }
        if($this->name=="")
        {
            throw new InvalidArgumentException("Invalid offer name");
        }
        return true;
    }
}