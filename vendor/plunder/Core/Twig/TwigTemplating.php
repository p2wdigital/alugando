<?php 

namespace Plunder\Core\Twig;

use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_Extension_Debug;
/**
* Twig Templating
*/
class TwigTemplating
{
	
	public function __construct(){
		return $this;
	}

	public function render($view, $args = array(), $display){

		$cacheDir 	= sprintf("app/cache/%s/twig", ENVIRONMENT);
		$debug 		= false;

		if (ENVIRONMENT == "dev") $debug = true;

		$loader = new Twig_Loader_Filesystem('src');
		$twig = new Twig_Environment($loader, array(
		    'cache' => $cacheDir,
		    'debug'=>$debug
		));
		$twig->addExtension(new Twig_Extension_Debug());

		if ($display):
			return $twig->display($view, $args);
		else:
			return $twig->render($view, $args);
		endif;
	}




}