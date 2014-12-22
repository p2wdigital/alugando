<?php

namespace Plunder\Core\Loader;

use Plunder\Helpers\Cache\Cache;
use Symfony\Component\Yaml\Parser;
use Plunder\Core\Container\Container;
use Plunder\Helpers\Annotation\AnnotationRouter;

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
	 * [init Inicializa elementos para o Framework]
	 * @return [type] [description]
	 */
	private function init(){
		//require_once (BASE_DIR."/app/propel/config_propel.php");
		new Container(new Parser());
		$route = Container::get('router');
		//var_dump($route);
		$routeParam = $route->getContext();
		
		$class 	= $routeParam['namespace'] . "\\" . $routeParam['class'];
		$params = $routeParam['params'];

		$method = new \ReflectionMethod($class, $routeParam['action']);
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