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

