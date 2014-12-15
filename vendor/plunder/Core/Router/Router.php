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
		//var_dump($routers, array("pathAux"=>$pathAux));

		foreach ($routers as $key => $value):
			
			if($this->checkRoute($path, $value)):
				return $value;
			endif;
		endforeach;

	}

	public function checkRoute($path, Array $route){
		$defaults = array();
		$requirements = array();
		$regGen = "[a-z A-Z 0-9]+";
		
		if($route['defaults'] != null && $route['defaults'] != "" ):
			$defaults = json_decode($route['defaults']);
		endif;
		if($route['requirements'] != null && $route['requirements'] != null ):
			$requirements = json_decode($route['requirements']);
		endif;
		
		preg_match_all("/\{(.*?)\}/i", $route['route'], $matches);
		
		if(count($matches[1])>0):
		endif;




		$routeAux = $route['route'];//preg_quote($route['route'], "/");

		var_dump(preg_split("/(\{)|(\})/", $routeAux));

		if(!preg_match("/^". $routeAux. "$/", $path)):
			return false;
		endif;

		return true;
	}
//*** Rotas
//   /admin/estoque/{page}
//   /admin/estoque/1

}