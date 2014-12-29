<?php

namespace Plunder\Core\Loader;

use Plunder\Helpers\Cache\Cache;
use Symfony\Component\Yaml\Parser;
use Plunder\Core\Container\Container;
use Plunder\Helpers\Annotation\AnnotationRouter;
use Plunder\Core\Config\Config;
use Table\Model\ClienteQuery;
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

		//require_once (BASE_DIR."/app/propel/config_propel.php");
		new Container(new Parser());
		new Config(Container::get('yaml'), Container::get('cache'));
		
		$route = Container::get('router');
		$this->callController($route->getContext());
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
		
		$method->invokeArgs($method->getDeclaringClass()->newInstance(), $arg);

	}



}