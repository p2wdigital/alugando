<?php

namespace Plunder\Core\Loader;

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
	 * [init Inicializa elementos elementos para o Framework]
	 * @return [type] [description]
	 */
	public function init(){
		$di = new Container(new Parser());

		$finder = Container::get('finder');
		var_dump($finder);

	}

}