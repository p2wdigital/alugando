<?php

namespace Plunder\Core\Loader;

use Plunder\Helpers\Cache\Cache;
use Symfony\Component\Yaml\Parser;
use Plunder\Core\Container\Container;

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



/*
		$finder = Container::get('finder');
		$yaml = Container::get('yam');
		var_dump(Container::$container);
*/
	}

}