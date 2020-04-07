<?php

//Add the initialization file
require_once 'core/init.php';

DB::getInstance()->query("SELECT * FROM users");