<?php
/**
 * Created by PhpStorm.
 * User: stass
 * Date: 12/5/2016
 * Time: 4:29 PM
 */
class DbConfig
{
    private static  $db_name="jini_db";
    private  static  $db_user="jini_db";
    private  static  $db_pass="9BnQJxE8";
    private static  $db_server="localhost";
    public  static function getDbInfo()
    {
        return array(
          "user"=>self::$db_user,
            "pass"=>self::$db_pass,
            "server"=>self::$db_server,
            "database"=>self::$db_name,
        );
    }
}