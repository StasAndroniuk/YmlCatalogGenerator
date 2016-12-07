<?php
/**
 * Created by PhpStorm.
 * User: stass
 * Date: 12/5/2016
 * Time: 4:29 PM
 */
class DbConfig
{
    private static  $db_name="database";
    private  static  $db_user="user";
    private  static  $db_pass="password";
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
