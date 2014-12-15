<?php 

namespace Plunder\Core\Router;

use Plunder\Core\HttpRequest\Request;
/**
* 
*/
class Router
{
	
	public function __construct(){
	
	}

	public function resolve(Request $request, $routers){
		$path = rtrim($request->getPathInfo(),"/");
		$pathAux = explode("/", $path);
		var_dump($routers, array("pathAux"=>$pathAux));

		foreach ($routers as $key => $value):
			$routeAux = explode("/", $value['route']);
			var_dump(array("routeAux"=>$routeAux));
			if ($value['route'] == $path):
				return $value;
			endif;
		endforeach;

	}

}