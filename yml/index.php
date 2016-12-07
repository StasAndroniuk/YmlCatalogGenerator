<?php
/**
 * Created by PhpStorm.
 * User: stass
 * Date: 12/5/2016
 * Time: 4:40 PM
 */
require_once("config.php");

foreach (glob("Entities/*.php") as $entity)
{
    require_once $entity;
}
//Example data

/*
     * data format array(
     *  [0]=>array(
     *       "id"=>value,
     *       "rate"=>value
     *    }
     *      ...
     *  )
     */
$currency_data=array(
  "0"=>array("id"=>"USD","rate"=>'1')
);
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
$category_data=array(
    "0"=>array("id"=>"1","name"=>"category1","parent"=>""),
    "1"=>array("id"=>"2","name"=>"category2","parent"=>"1"),
    "2"=>array("id"=>"3","name"=>"category3","parent"=>""),
);
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
$offers_data=array(
    "0"=>array(
        "id"=>1,
        "price"=>12.5,
        "name"=>"product1",
        "model"=>"v1",
        "vendor"=>"vendor",
        "url"=>"http://google.ru",
        "currencyId"=>"USD",
        "categoryId"=>2,
        "pictures"=>array(
          "0"=>"http://google.ru/pic1.jpg"
        ),
    )
);
$shopname="shopname";
$company="company";
$url="http://google.ru";

$catalog=new YmlCatalog($shopname,$company,$url);
try
{
    $catalog->pushCategories($category_data);
    $catalog->pushCurrencies($currency_data);
    $catalog->pushOffers($offers_data);
    $catalog->genearate();
}
catch (Exception $e)
{
    print_r($e);
}
