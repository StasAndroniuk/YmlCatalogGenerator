<?php
/**
 * Created by PhpStorm.
 * User: stass
 * Date: 12/7/2016
 * Time: 1:29 PM
 */
$db_info=DbConfig::getDbInfo();
/*
     * data format array(
     *  [0]=>array(
     *       "id"=>value,
     *       "rate"=>value
     *    }
     *      ...
     *  )
     */
$currency_data=array();
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

$category_data=array();
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
$offers_data=array();
$shopname="";
$company="";
$url="http://".$_SERVER['SERVER_NAME'];
