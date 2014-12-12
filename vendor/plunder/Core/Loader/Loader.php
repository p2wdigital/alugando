<?php

namespace Plunder\Core\Loader;

use Plunder\Helpers\Cache\Cache;
use Symfony\Component\Yaml\Parser;
use Plunder\Core\Container\Container;
use Plunder\Helpers\Annotation\AnnotationRouter;
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
		$di = new Container(new Parser());
		var_dump(Container::get('cache'));
		//$annotation		= new AnnotationRouter(Container::get('finder'), Container::get('cache'));
		//$routers 		= 




/*
		$finder = Container::get('finder');
		$yaml = Container::get('yam');
		var_dump(Container::$container);
*/
	}

}