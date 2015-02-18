<?php 

namespace Plunder\Core\Controller;

use Plunder\Core\Container\Container;
use Plunder\Core\Twig\TwigTemplating;
use Plunder\Core\Router\Router;
use Plunder\Core\HttpRequest\Request;
use Plunder\Core\HttpRequest\Response;
use Plunder\Core\HttpRequest\RedirectResponse;

/**
* Class Controller
*/
class Controller 
{
	protected $request;

	public function __construct(){
		$this->request = Container::get('request');
	}

	protected function render($templating, $args = array(), $display = true){
		$twig = Container::get('templating');

		if($display):
			return new Response($twig->render($templating, $args + array('app'=>Container::get('app')), $display));
		else:
			return $twig->render($templating, $args + array('app'=>Container::get('app')), $display);
		endif;
		
	}

	protected function generateUrl($name, $param = array()){
		$route = Container::get('router');
		return $route->generateUrl($name, $param);
	}

	protected function redirect($url, $status = 302){
		return new RedirectResponse($url, $status);
	}


}