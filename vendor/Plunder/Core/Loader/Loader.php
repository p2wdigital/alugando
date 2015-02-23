<?php

namespace Plunder\Core\Loader;

use Symfony\Component\Yaml\Parser;
use Plunder\Core\Config\Config;
use Plunder\Helpers\Cache\Cache;
use Plunder\Core\Container\Container;
use Plunder\Core\HttpRequest\Response;



/**
* Loader Class
*/
class Loader
{
	public function __construct(){
		$this->init();
		return $this;
	}

	/**
	 * [init Inicializa elementos essenciais para o Framework]
	 * @return [type] [description]
	 */
	private function init(){
		//Include propel class;
		require_once (BASE_DIR."/app/config/config_propel.php");

		new Container(new Parser());
		new Config(Container::get('yaml'), Container::get('cache'));
		
		$route = Container::get('router');
		if($route->getContext() != array()):
			Container::load("app", $route->getContext());
			$this->callController($route->getContext());
		else:
			$response = new Response("404 Error", 404);
			$response->send();
		endif;
	}


	/**
	 * [callController Chama o Method do Controller que 
	 *  corresponde ao Contexto da Rota]
	 * @param  [type] $route [Contexto da Rota]
	 * @return [type]        [null]
	 */
	private function callController($route){
		$class 	= $route['namespace'] . "\\" . $route['class'];
		$params = $route['params'];

		$method = new \ReflectionMethod($class, $route['action']);
		$parameters = $method->getParameters();
		$arg = array();
		foreach ($parameters as $key => $value):
			if(!array_key_exists($value->getName(), $params)):
				if ($value->getClass() == null):
					if(!$value->isOptional()):
						throw new \Exception("Parametros inválidos para a rota", 1);
					endif;
				else:
					$arg[] = $value->getClass()->newInstance();
				endif;
			else:
				$arg[] = $params[$value->getName()];
			endif;
		endforeach;
		
		$response = $method->invokeArgs($method->getDeclaringClass()->newInstance(), $arg);
		if ($response instanceof Response):
			$response->send();
		else:
			throw new \Exception("Controller não retornou nenhuma resposta!", 500);
		endif;

	}



}