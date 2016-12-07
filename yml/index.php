<?php
/**
 * Created by PhpStorm.
 * User: stass
 * Date: 12/5/2016
 * Time: 4:40 PM
 */
//Set config of your database
require_once("config.php");

foreach (glob("Entities/*.php") as $entity)
{
    require_once $entity;
}
//Data
print_r('<pre>');
//use this file to get data from database
require_once "dataGeneration.php";
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
