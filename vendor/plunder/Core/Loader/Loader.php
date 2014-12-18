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
		

		new Container(new Parser());
		$route = Container::get('router');

		var_dump($route->getContext());
		




	}

}