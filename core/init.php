<?php
//Initialization file to include all classes


//Allow people to login
session_start();

//Create a configuration setting

$GLOBALS['config'] = array(

    //DB properties
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'oop_php'
    ),

    //Cookie remember time
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),

    'session' => array(
        'session_name' => 'user'
    )
);


//Parse a function that is run when a class is accessed
//Require classes as needed
spl_autoload_register(function ($class) {
    require_once 'classes/' . $class . '.php';
});
// Include de sanitization function
require_once 'functions/sanitize.php';