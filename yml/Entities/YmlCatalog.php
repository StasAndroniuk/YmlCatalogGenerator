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
    private $path;
    private $filename="yml.yml";
    public  function __construct($shopname,$company,$url)
    {
        $this->shop=new YmlShop($shopname,$url,$company);
    }
    public function setDirectoryPath($path)
    {
        $this->path=$path;
    }
    public function setFilename($name)
    {
        if($name=="")
        {
            throw new InvalidArgumentException("Empty  filename");
        }
        $this->filename=$name;
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
    public function pushCurrencies($data)
    {
        $this->shop->addCurrencies($data);
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
    public function pushCategories($data)
    {
        $this->shop->addCategories($data);
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
    public function pushOffers($data)
    {
        $this->shop->addOffers($data);
    }
    public function genearate()
    {
        $str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
        $str .= "<yml_catalog date=\"" . date("Y-m-d H:m") . "\">";
        $str .= $this->shop->generate();
        $str .= "</yml_catalog>";
        file_put_contents($this->path.$this->filename,$str);
        echo"File ".$this->path.$this->filename." saved";
    }
}