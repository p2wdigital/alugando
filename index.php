<?php 
// SETUP AUTO LOAD COMPOSER
require_once 'vendor/autoload.php';
use Plunder\Core\Loader\Loader;
use Symfony\Component\Finder\Finder;
//get statart time;
$ini = microtime(true);


//DEFINES ENVIRONMENT (dev | prod);
define("ENVIRONMENT", "prod");
define("BASE_DIR", __DIR__);
define("SEP", DIRECTORY_SEPARATOR);

$loader = new Loader();


$debug = array(
	"Memoria"=>memory_get_peak_usage(true)/1024/1024 . "MB",
	"Time"=>number_format((microtime(true) - $ini),3) ." ms",
);
var_dump($debug);



