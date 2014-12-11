<?php 
use Plunder\Core\Loader\Loader;

// SETUP AUTO LOAD COMPOSER
require_once 'vendor/autoload.php';

//DEFINES
define("PROD", false);
define("BASE_DIR", __DIR__);

$loader = new Loader();
