<?php
//File to draw configurations for Data Base

/**
 * Class Config
 */
class Config
{

    /**
     * @param null $path
     * This function help ease the use of $GLOBAL variable for getting configuration elements in it
     * @return mixed
     *
     */
    public static function get($path = null)
    {

        //Check if path exist
        if ($path) {
            $config = $GLOBALS['config'];
            //Explode the path to get array
            $path = explode('/', $path);

            //Loop through the $path variable
            //If the first element exist, we change config to that element and so on
            foreach ($path as $bit) {
                if (isset($config[$bit])) {
                    $config = $config[$bit];
                }
            }

            return $config;
        }

        return false;
    }
}