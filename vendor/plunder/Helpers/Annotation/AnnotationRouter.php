<?php 

namespace Plunder\Helpers\Annotation;
use Plunder\Helpers\Cache\Cache;
use Symfony\Component\Finder\Finder;
/**
* Class Annotation Router
*/
class AnnotationRouter extends Annotation
{
	protected $route = array();

	public function __construct(Finder $finder, Cache $cache){
		$fileCache	= "plunder.route";

		if(ENVIRONMENT == 'prod' && $cache->existsFile($fileCache)):
			$this->route = $cache->getCache($fileCache);
			return $this;
		endif;

		$finder->name("*Controller.php");
		$finder->files()->in(BASE_DIR."/src");

		if(ENVIRONMENT == 'dev' && $this->verifyCache($fileCache, $finder, $cache) == false):
			$this->route = $cache->getCache($fileCache);
			return $this;
		endif;

		foreach ($finder as $key => $value):
			$this->route = array_merge( $this->route, $this->handleFile($value->getContents()) );
		endforeach;
		
		$cache->setCache($fileCache, $this->route, $finder);
		return $this;

	}

	private function handleFile($content){
		//Separa cada linha da class em um array;
		$file 		= explode("\n", $content);
		$result 	= array();

		//Filtra apenas as ocorrencias necessárias para gerar a rota;
		foreach ($file as $key => $value):
			$namespace 	= $this->getNamespace($value);
			$class 		= $this->getClassName($value);
			$route 		= $this->getRouteParam($value);
			$function 	= $this->getFunction($value);
			
			if ($namespace 	!== false) $result[] = $namespace;
			if ($class     	!== false) $result[] = $class;
			if ($route     	!== false) $result[] = $route;
			if ($function 	!== false) $result[] = $function;
		endforeach;
		//Gera as rotas finais com a saída filtrada, e retorna;
		return $this->routeGenerate($result);

	}
	private function routeGenerate($array){
		$class 		= null;
		$route 		= array();
		$auxRoute 	= array();
		$namespace 	= null;
		$classRoute = array();

		foreach ($array as $key => $value):
			// Guarda Namespace da class				
			if (array_key_exists("namespace", $value)):
				$namespace = $value['namespace'];
			endif;

			// Acumula todas as rotas na aux Route 
			if(array_key_exists("route", $value)):
				$auxRoute[] = $value;
			endif;

			// Guarda os dados da classe e verifica se existe uma rota
			if(array_key_exists("class", $value)):
				
				$class = $value['class'];
				//Gera todas as rotas encontradas antes do class
				foreach ($auxRoute as $key => $item):
					$route[] = array(
						"namespace"=>$namespace, 
						"class"=>$class, 
						"route"=> strtolower(rtrim($item['route'], "/")),
						"name"=>$item['name'], 
						"action"=>"indexAction"

					);
				endforeach;
				//Guarda as rotas da classe
				$classRoute = $auxRoute;
				if($classRoute == array()) $classRoute = array("route"=>"", "name"=>"");
				//Limpa o array de rotas auxiliares
				$auxRoute = array();
			endif;

			// Gera rota da function com todas as ocorrencias da rota da class 
			if(array_key_exists("function", $value)):

				foreach ($classRoute as $key => $c):
					foreach ($auxRoute as $key => $rota):
						$route[] = array(
							"namespace"=>$namespace, 
							"class"=>$class, 
							"route"=> strtolower(rtrim($c['route'] . $rota['route'], "/")), 
							"name"=>$rota['name'], 
							"action"=>$value['function'],
							"defaults"=>(array_key_exists("defaults", $rota)) ? $rota['defaults'] : "",
							"requirements"=>(array_key_exists("requirements", $rota)) ? $rota['requirements'] : "",
							"method"=>(array_key_exists("method", $rota)) ? $rota['method'] : "",
						);
					endforeach;
				endforeach;
				$auxRoute = array();
			endif;

		endforeach;	
		if($namespace == null):
			throw new \Exception("Controller sem namespace", 1);
		endif;
			

		return $route;
	}

	private function getNamespace($value){

		if(strpos($value, "namespace") !== false):
			$replace = array(" ", "namespace", ";");
			$str = str_replace($replace, "", trim($value));
			return array("namespace"=>$str);
		endif;

		return false;

	}


	private function getClassName($value){
		
		if(strpos($value, "class") !== false):
			$replace = array(" ", "class", "{");
			$str = str_replace($replace, "", trim($value));
			return array("class"=>$str);
		endif;

		return false;
	}


	private function getRouteParams($value){

		if(strpos($value, "@Route") !== false):

			$replace = array(" ", "@Route", "*", "(", ")", "name=", "\"");
			$str = str_replace($replace, "", trim($value));

			$router = explode(",",$str);
			return array("route"=>$router[0],"name"=>array_key_exists(1, $router) ? $router[1]:"");
		endif;

		return false;

	}

	private function getRouteParam($value){

		if(strpos($value, "@Route") !== false):
			//Retira espaços em branco, @route, " , ', que não estiverem no padrao {"id":value}
			$str = preg_replace("/(\=\{.*?\})|((\"+)|@route\(|\s+|\*|\))/i", "$1", $value);

			//Gera array com o delimitador ,
			$aux = explode("," ,$str);
			$route = array();
			foreach ($aux as $key => $value):

				//Gera array de chave e valor dos parametros
				$auxRoute = explode("=", $value);
				if(count($auxRoute)== 1):
					$route['route'] = rtrim($auxRoute[0], "/");
				elseif (count($auxRoute) == 2):
					$route[$auxRoute[0]] = $auxRoute[1];
				endif;
			endforeach;

			if(!array_key_exists('name', $route)) $route['name']="";
			
			return $route;
		endif;

		return false;

	}



	private function getFunction($value){
		
		if(strpos($value, "function") !== false):
			$replace = array(" ", "public", "function", ";");
			$str = str_replace($replace, "", trim($value));
			$str = explode("(", $str);
			return  array("function"=>trim($str[0]));
		endif;	
		return false;	

	}

	//* GET *//
	public function getRoute(){
		return $this->route;
	}

}