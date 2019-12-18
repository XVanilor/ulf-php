<?php

use App\Modules\Helper;

$helper = new Helper();

//Loads configuration
$config = $helper->getConfig();

//Base functions
require_once '../App/Modules/Funcs.php';

//Loads routes
$routes = routes();