<?php
/**
 * Created by PhpStorm.
 * User: valeriishinkar
 * Date: 11/20/18
 * Time: 12:00
 */

namespace ValeriyShinkar\Models;

class Config
{
    private static $items = array();

    /**
     * Method to set a config item.
     *
     * @param string $name  Name of item
     * @param mixed  $value Value of item
     */
    public static function setItem($name, $value){
        self::$items[$name] = $value;
    }
    /**
     * Method to get an option item.
     *
     * @param  string $name Name of item
     * @return mixed        Value of item
     */
    public static function getItem($name){
        return self::has($name) ? self::$items[$name] : null;
    }

    /**
     * Conditional method to confirm the existence of an item.
     *
     * @param  string  $item Name of item
     * @return boolean       If exists or not
     */
    public static function has($item){

        if(!self::$items)
            self::$items = include_once(dirname(__FILE__).'/../config/parameters.php');

        return array_key_exists($item, self::$items);
    }

}