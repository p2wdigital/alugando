<?php 

namespace Plunder\Core\Controller;

use Plunder\Core\Container\Container;
use Plunder\Core\Twig\TwigTemplating;
use Plunder\Core\Router\Router;
use Plunder\Core\HttpRequest\Request;

/**
* Class Controller
*/
class Controller 
{
	public function __construct(){
		
	}

	public function render($templating, $args = array(), $display = true){
		$twig = Container::get('templating');
		return $twig->render($templating, $args, $display);
	}


	private function changeNameTemplating($name){
		$aux 		 = explode(":", $name);
		$aux 		= array_filter($aux);

		$caminho 	 = sprintf("%s/View/", $aux[0]);
		unset($aux[0]);
		$caminho 	.= implode("/", $aux);

		return $caminho;
	}
}