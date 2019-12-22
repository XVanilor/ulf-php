<?php
use App\Core\Helper;

$helper = new Helper();

//Loads configuration
$config = $helper->getConfig();

//Base functions
require_once '../App/Core/Funcs.php';

//Loads routes
$routes = routes();