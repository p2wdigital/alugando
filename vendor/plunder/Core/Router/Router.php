<?php 

namespace Plunder\Core\Router;

use Plunder\Core\HttpRequest\Request;
use Plunder\Helpers\Annotation\AnnotationRouter;
/**
* 
*/
class Router
{
	protected $context = array();
	protected $name;

	protected $request;
	protected $annotationRouter;

	public function __construct(Request $request, AnnotationRouter $routers){
		$this->request = $request;
		$this->annotationRouter = $routers;
		$this->resolve();
		return $this;
	}
	/**
	 * [resolve Verifica a rota do navegador e tenta]
	 * @param  Request $request [description]
	 * @param  [type]  $routers [description]
	 * @return [type]           [description]
	 */
	public function resolve(){
		$path 		= rtrim($this->request->getPathInfo(),"/");
		$routers 	= $this->annotationRouter->getRoute();

		foreach ($routers as $key => $value):
			if($this->checkRoute($path, $value)):
				return;
			endif;
		endforeach;

	}
	/**
	 * [checkRoute Através da rota enviada é informado ]
	 * @param  [type] $path  [description]
	 * @param  Array  $route [description]
	 * @return [type]        [description]
	 */
	public function checkRoute($path, Array $route){
		$defaults = array();
		$requirements = array();
		$reg = array(
				"defaults"			=> "?[\w-.]*",
				"defaultsValues"	=> "?([\w-.]*)",
				"notDefaults"		=> "[\w-.]+",
				"notDefaultsValues"		=> "([\w-.]+)",
		);

		if($route['defaults'] != null && $route['defaults'] != "" ):
			$defaults =(array) json_decode($route['defaults']);
		endif;
		if($route['requirements'] != null && $route['requirements'] != "" ):
			$requirements = (array)json_decode(addcslashes($route['requirements'],"\\"));
		endif;
		preg_match_all("/\{(.*?)\}/i", $route['route'], $matches);
				
		//var_dump($matches);

		$routeAux 	= $routeValues	= str_replace("/", "\/", $route['route']);
		$mask 		= $matches[0];
		$routeKeys	= $matches[1];
		
		foreach ($routeKeys as $key => $value):
				if(array_key_exists($value, $defaults)):
					if(array_key_exists($value, $requirements)):
						$routeAux 		= str_replace($mask[$key], "?".$requirements[$value], $routeAux);
						$routeValues 	= str_replace($mask[$key], "?(".$requirements[$value] . ")", $routeValues);
					else:
						$routeAux 		= str_replace($mask[$key], $reg['defaults'], $routeAux);
						$routeValues 	= str_replace($mask[$key], $reg['defaultsValues'], $routeValues);
					endif;
				else:
					if(array_key_exists($value, $requirements)):
						$routeAux 		= str_replace($mask[$key], $requirements[$value], $routeAux);
						$routeValues 	= str_replace($mask[$key], "(" . $requirements[$value] .")", $routeValues);
					else:
						$routeAux		= str_replace($mask[$key], $reg['notDefaults'], $routeAux);
						$routeValues 	= str_replace($mask[$key], $reg['notDefaultsValues'], $routeValues);
					endif;
				endif;
		endforeach;


		//$routeAux = preg_quote($route['route'], "/");
		//var_dump($routeAux);
		

		if(!preg_match("/^". $routeAux. "$/", $path)):
			return false;
		endif;
		
		preg_match_all("/". $routeValues ."/", $path, $valores, PREG_SET_ORDER );
		unset($valores[0][0]);
		$valores = array_combine($routeKeys, array_values($valores[0]) );
		$fullValues = array_merge($defaults, array_filter($valores));
		$route['params'] = $fullValues;
		$this->context = $route;

		return true;
	}

	public function getContext(){
		return $this->context;
	}

	public function getName(){
		if(array_key_exists("name", $this->context)):
			return $this->context['name'];
		else:
			return null;
		endif;
	}

//*** Rotas
//   $route = /admin/estoque/{page}
//   $path  = /admin/estoque/1 | /admin/estoque
//   

}