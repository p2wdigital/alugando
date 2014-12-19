<?php 
use Plunder\Core\Loader\Loader;
use Symfony\Component\Finder\Finder;
//get statart time;
$ini = microtime(true);

//echo "<br>" . microtime(true);


// SETUP AUTO LOAD COMPOSER
require_once 'vendor/autoload.php';

//DEFINES ENVIRONMENT (dev | prod);
define("ENVIRONMENT", "prod");
define("BASE_DIR", __DIR__);
$loader = new Loader();


//$path = "plunder.route";
//echo sprintf("%s/app/cache/%s/%s.cache", BASE_DIR, ENVIRONMENT, str_replace(".", "/", $path));
//$path = "plunder.config";
//echo sprintf("%s/app/cache/%s/%s.cache", BASE_DIR, ENVIRONMENT, str_replace(".", "/", $path));
/*
$finder = new Finder();
$finder->name("*Controller.php");
$finder->files()->in(BASE_DIR."/src");
*/
/*foreach ($finder as $key => $value) {
	var_dump($value->getATime());
	var_dump($value->getMTime());
	var_dump($value->getCTime());
	var_dump($value->getPathname());
	//var_dump(get_class_methods($value));
	
}
*/
$debug = array(
	"Memoria"=>memory_get_peak_usage(true)/1024/1024 . "MB",
	"Time"=>number_format((microtime(true) - $ini),3) ." ms",
);
var_dump($debug);



