<?php 

namespace Plunder\Core\Router;

use Plunder\Core\HttpRequest\Request;
use Plunder\Core\Annotation\AnnotationRouter;
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
				break;
			endif;
		endforeach;
		
		if(@$this->context['method'] !== null):
			if ($this->request->getMethod() != $this->context['method']):
				$this->context = array();
			endif;
		endif;
	}

	/**
	 * [checkRoute Através da rota enviada é informado ]
	 * @param  [type] $path  [description]
	 * @param  Array  $route [description]
	 * @return [type]        [description]
	 */
	public function checkRoute($path, Array $route){
		$defaults = array();
		$regex = array();
		$reg = array(
				"defaults"			=> "(\/)?(?(1)[\w-.]*)",
				"defaultsValues"	=> "?([\w-.]*)",
				"notDefaults"		=> "[\w-.]+",
				"notDefaultsValues"		=> "([\w-.]+)",
		);
		
		if($route['defaults'] != null && $route['defaults'] != "" ):
			$defaults =(array) json_decode($route['defaults']);
		endif;
		if($route['regex'] != null && $route['regex'] != "" ):
			$regex = (array)json_decode(addcslashes($route['regex'],"\\"));
		endif;
		preg_match_all("/\{(.*?)\}/i", $route['prefix'].$route['route'], $matches);
				
		//var_dump($matches);

		$routeAux 	= $routeValues	= str_replace("/", "\/", rtrim($route['prefix'] .$route['route'],"/"));
		$mask 		= $matches[0];
		$routeKeys	= $matches[1];
		
		foreach ($routeKeys as $key => $value):
				if(array_key_exists($value, $defaults)):
					if(array_key_exists($value, $regex)):
						$routeAux 		= str_replace($mask[$key], "?".$regex[$value], $routeAux);
						$routeValues 	= str_replace($mask[$key], "?(".$regex[$value] . ")", $routeValues);
					else:
						$routeAux 		= str_replace("\/".$mask[$key], $reg['defaults'], $routeAux);
						$routeValues 	= str_replace($mask[$key], $reg['defaultsValues'], $routeValues);
					endif;

				else:
					if(array_key_exists($value, $regex)):
						$routeAux 		= str_replace($mask[$key], $regex[$value], $routeAux);
						$routeValues 	= str_replace($mask[$key], "(" . $regex[$value] .")", $routeValues);
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


	public function generateUrl($name, $params = array(), $relative =true){
		$route = $this->annotationRouter->getRoute();
		
		if(!array_key_exists($name, $route)):
			var_dump($route);
			throw new \Exception("Class Router->generateUrl erro \n Rota não encontrada " .$name, 500);
		endif;

		$aux = $route[$name]['prefix'].$route[$name]['route'];
		
		foreach ($params as $key => $value):
			$aux = str_replace("{". $key ."}", $value, $aux);
		endforeach;
		$aux = explode("{", $aux);
		$aux = $aux[0];


		if($relative):
			return $this->request->getBase() . $aux;
		else:
			$server = $this->request->server;
			return sprintf("%s://%s%s", $server->get("REQUEST_SCHEME", "http"), $server->get('HTTP_HOST')
							,$this->request->getBase() . $aux);
		endif;
	}


//*** Rotas
//   $route = /admin/estoque/{page}
//   $path  = /admin/estoque/1 | /admin/estoque
//   

}