<?php 
// SETUP AUTO LOAD COMPOSER
require_once 'vendor/autoload.php';
use \Plunder\Core\Loader\Loader;
use Symfony\Component\Finder\Finder;
//get statart time;
$ini = microtime(true);

//echo "<br>" . microtime(true);




//DEFINES ENVIRONMENT (dev | prod);
define("ENVIRONMENT", "dev");
define("BASE_DIR", __DIR__);
define("SEP", DIRECTORY_SEPARATOR);
echo "ola mundo";

$loader = new Loader();


$var = "orcamento";
$var = explode("_", $var);
$x = array_map('ucfirst', $var);
var_dump(implode("", $x));


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



