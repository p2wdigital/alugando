<?php 
use Plunder\Core\Loader\Loader;
use Symfony\Component\Finder\Finder;
//get statart time;
$ini = microtime(true);

//echo "<br>" . microtime(true);


// SETUP AUTO LOAD COMPOSER
require_once 'vendor/autoload.php';

//DEFINES ENVIRONMENT (dev | prod);
define("ENVIRONMENT", "dev");
define("BASE_DIR", __DIR__);
$loader = new Loader();

echo number_format((microtime(true) - $ini),3) ." ms";



$finder = new Finder();
$finder->name("*Controller.php");
$finder->files()->in(BASE_DIR."/src");

foreach ($finder as $key => $value) {
	var_dump($value->getATime());
	var_dump($value->getMTime());
	var_dump($value->getCTime());
	var_dump(stat($value->getPathname()));
	var_dump(get_class_methods($value));
	
}





