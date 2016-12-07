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
    public function __construct($name,$url,$company)
    {
        if($name=="" || $company=="" || $url=="")
        {
            throw new InvalidArgumentException("Invalid shop data");
        }
        $this->name=$name;
        $this->url=$url;
        $this->company=$company;
    }

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
    /*
     * data format array(
     *  [0]=>array(
     *       "id"=>value,
     *       "rate"=>value
     *    }
     *      ...
     *  )
     */
    public function addCurrencies($data)
    {
        if(!is_array($data) || $data=="")
        {
            throw new InvalidArgumentException("Invalid curreny data");
        }
        if(count($data)==0)
        {
            throw new InvalidArgumentException("Empty currency data");
        }
        foreach ($data as $currency)
        {
            $this->currencies[]=new YmlCurrency($currency['id'],$currency['rate']);
        }
    }
    /*
     * data format array(
     *  [0]=>array(
     *       "id"=>value,
     *       "name"=>value,
     *       "parent"=>value or ""
     *    }
     *      ...
     *  )
     */
    public function addCategories($data)
    {

        if(!is_array($data) || $data=="")
        {
            throw new InvalidArgumentException("Invalid category data");
        }
        if(count($data)==0)
        {
            throw new InvalidArgumentException("Empty category data");
        }
        foreach ($data as $category)
        {
            $this->categories[]=new YmlCategory($category['id'],$category['name'],$category['parent']);
        }
    }
    /*
      * data format array(
      *  [0]=>array(
      *       "id"=>value,
     *        "price"=>value,
     *        "name"=>value,
     *        "model"=>value,
     *        "vendor"=>velue,
     *        "url"=>value,
     *        "currencyId'=>value,
     *        "categoryId"=>value,
     *        "pictures"=>array(
     *                      [0]=>value,
     *                      ),
      *       "type"=>value or "",
      *       "store'=>value or "",
      *       "oldPrice"=>value or "",
     *        "available"=>value or "",
     *        "description"=>value or "",
     *        "age"=>value or "",
     *        "salesNodes"=>value or "",
     *        "barcode"=>value or ""
     *        "params"=>array(
     *                      [0]=>array(
     *                                  "name"=>value,
     *                                  "value"=>value,
     *                                  "unit"=>value or "",
     *                      ),
     *
      *    }
      *      ...
      *  )
      */
    public function addOffers($data)
    {
        if(!is_array($data))
        {
            throw new InvalidArgumentException("Invalid offers data");
        }
        if(count($data)==0)
        {
            throw new InvalidArgumentException("Empty offers data");
        }
        foreach ($data as $offer)
        {
            $temp_offer=new YmlOffer($offer['id']);
            $temp_offer->setOfferPrice($offer['price']);
            $temp_offer->setofferName($offer['name']);
            $temp_offer->setOfferModel($offer['model']);
            $temp_offer->setOfferVendor($offer['vendor']);
            $temp_offer->setOfferUrl($offer['url']);
            $temp_offer->setCategoryId($this->categoryExists($offer['categoryId']));
            $temp_offer->setCureency($this->currencyExists($offer['currencyId']));
            if(count($offer['pictures'])==0)
            {
                throw new InvalidArgumentException("offer ".$offer['id']." not have pictures");
            }
            foreach ($offer['pictures'] as $pic)
            {
                $temp_offer->addPicture($pic);
            }
            if(isset($offer['type']) && $offer['type']!=$temp_offer->getofferType())
            {
                $temp_offer->setOfferType($offer['type']);
            }
            if(isset($offer['store']) && $temp_offer->getStoreType()!=$offer['store'])
            {
                $temp_offer->changeStoreType();
            }
            if(isset($offer['oldPrice']))
            {
                $temp_offer->setOldPrice($offer['oldPrice']);
            }
            if(isset($offer['available']))
            {
                $temp_offer->changeAvaliableStatus();
            }
            if(isset($offer['description']))
            {
                $temp_offer->setOfferDescription($offer['description']);
            }
            if(isset($offer['age']))
            {
                $temp_offer->setOfferAge($offer['age']);
            }
            if(isset($offer['salesNodes']))
            {
                $temp_offer->setSalesNotes($offer['salesNodes']);
            }
            if(isset($offer['barcode']))
            {
                $temp_offer->setOfferBarcode($offer['barcode']);
            }
            if(isset($offer['params']) && count($offer['params'])>0)
            {
                foreach ($offer['params'] as $param)
                {
                    $temp_offer->addOfferParam(new YmlOfferParameter($param['id'],$param['value'],$param['unit']));
                }
            }
            $this->offers[]=$temp_offer;
        }
    }
    public function generate()
    {
        $shop="<shop>";
        $shop.="<name>".$this->name."</name>";
        $shop.="<company>".$this->company."</company>";
        $shop.="<url>".$this->url."</url>";
        //currencies
        if(count($this->currencies)==0)
        {
            throw new Exception("0 shop currencies");
        }
        $shop.="<currencies>";
        foreach ($this->currencies as $currency)
        {
            $shop.=$currency->generate();
        }
        $shop.="</currencies>";
        //categories
        if(count($this->categories)==0)
        {
            throw new Exception("0 categories");
        }
        $shop.="<categories>";
        foreach ($this->categories as $category)
        {
            $shop.=$category->generate();
        }
        $shop.="</categories>";
        $shop.="<offers>";
        if(count($this->offers)==0)
        {
            throw new Exception("0 offers");
        }
        foreach ($this->offers as $offer)
        {
            $shop.=$offer->generate();
        }
        $shop.="</offers>";

        $shop.="</shop>";
        return $shop;
    }

    private function currencyExists($id)
    {
        if(count($this->currencies)==0)
        {
            throw new Exception("There are no currencies");
        }
        foreach ($this->currencies as $currency)
        {
            if($currency->getCurrencyId()==$id)
            {
                return $currency;
            }
        }
        throw new InvalidArgumentException("Currency $id not exists");
    }
    private function categoryExists($id)
    {
        if(count($this->categories)==0)
        {
            throw new Exception("There are no categories in shop");
        }
        foreach ($this->categories as $category)
        {
            if($category->getCategoryid()==$id)
            {
                return $category;
            }
        }
        throw new InvalidArgumentException("category $id not exists");
    }
}