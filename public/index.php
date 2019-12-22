<?php

//Start session
if(!session_id()) @session_start();

require_once "../App/Startup.php";

//uri = explode("/", strip_tags($_SERVER['REQUEST_URI'])); Future update
$uri = strtok(strtok(strip_tags($_SERVER['REQUEST_URI']), "?"), "&");

array_key_exists($uri, $routes) ? include_once $config["paths"]['views'].$routes[$uri].".php" : include_once $config["paths"]["views"].$routes["/404"].".php";