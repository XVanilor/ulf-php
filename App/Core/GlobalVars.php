<?php
use App\Core\Helper;

//Loads configuration
$config = Helper::getConfig();
//Base functions
require_once '../App/Core/Funcs.php';
//Loads routes
$routes = routes();
