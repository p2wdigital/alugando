<?php 

namespace Plunder\Core\Twig;

use Plunder\Core\Twig\Functions\FormTwig;
use Plunder\Core\Twig\Functions\UrlTwig;
use Twig_Extension_Debug;


/**
* Twig Templating
*/
class TwigTemplating
{
	
	public function __construct(){
		return $this;
	}

	public function render($view, $args = array()){

		$cacheDir 	= sprintf("app/cache/%s/twig", ENVIRONMENT);
		$debug 		= false;

		if (ENVIRONMENT == "dev") $debug = true;

		$loader = new TwigLoaderFilesystem(array('src', 'app/View'));
		$twig = new \Twig_Environment($loader, array(
		    'cache' => $cacheDir,
		    'debug'=>$debug
		));
		$twig->addExtension(new Twig_Extension_Debug());
		$twig->addExtension(new FormTwig);
		$twig->addExtension(new UrlTwig);
		
		return $twig->render($view, $args);
		
	}




}