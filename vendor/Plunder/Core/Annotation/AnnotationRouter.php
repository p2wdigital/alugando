<?php

namespace Plunder\Core\Annotation;

use Symfony\Component\Finder\Finder;

/**
* Annotation Router
* Esta Class é resposavel por traduzir as rotas inseridas como anotação
* nas Class do controller
* A seguinte lista de comandos é utilizada pela AnnotationRouter:
* @Router("url/sub-url/{id}", name="nome_router");
* @Prefix("/name-bundle")  -> Prefixo é utilizado para todas as Rotas
* @Method("[POST or GET]");
* @Defaults({id:"default-id"});
* @Regex({id: "\d"});
* @Http("https or http");
*
* Além das anotações acima, esta classe utiliza o namespace PHP e o nome da Class;
*/
class AnnotationRouter extends Annotation
{

	protected $route;
	protected $prefix;
	protected $namespace;


	/**
	 * 
	 */
	public function __construct(){
		// Obtem a lista de todos os arquivos na pasta src
		// com o finel *Controller.php
		$finder = new Finder();
		$finder->name("*Controller.php");
		$finder->files()->in(BASE_DIR."/src");

		foreach ($finder as $key => $value):
			$this->handleFile($value->getContents());
		endforeach;
		//var_dump($this->route);
	
	}

	/**
	 * Trata cada arquivo *Controller.php
	 */
	protected function handleFile($content){
		//Transforma o conteudo do arquivo em um array separado por linhas
		//e aplica um filtro para retornar apenas as linhas necessárias ao processo; 
		$auxContent = array_filter(explode("\n", $content), array($this, 'clearFile'));
		$r 	= array();
		
		foreach ($auxContent as $key => $value):
			$namespace 	= $this->getNamespace($value);
			$function 	= $this->getFunction($value);
			$class 		= $this->getClassName($value);
			$route 		= $this->getRouter($value);
			$prefix 	= $this->getPrefix($value);
			$defaults 	= $this->getDefaults($value);
			$method 	= $this->getMethod($value);
			$http 		= $this->getHttp($value);
			$regex 		= $this->getRegex($value);
			
			if ($namespace 	!== false) $r['namespace'] 	= $namespace;
			if ($class     	!== false) $r['class'] 		= $class;
			if ($prefix     !== false) $r['prefix'] 	= $prefix;
			if ($route     	!== false) $r['route'][] 	= $route;
			if ($defaults   !== false) $r['defaults'] 	= $defaults;
			if ($method     !== false) $r['method'] 	= $method;
			if ($http     	!== false) $r['http'] 		= $http;
			if ($regex     	!== false) $r['regex'] 		= $regex;
			
			if ($function 	!== false):
				$r['action'] = $function;
				//var_dump($r);
				$this->generateRouters($r);
				unset($r['route'], $r['defaults'], $r['method'], $r['http'], $r['regex']);
			endif;
		endforeach;
	}

	protected function generateRouters(array $arr){
		if (!isset($arr['namespace'])):
			throw new Exception("Erro ao gerar a rota, namespace não encontrado.", 500);
		endif;

		if(!isset($arr['class'])):
			throw new Exception("Erro ao gerar a rota Class não encontrada", 500);
		endif;
			
		if(!isset($arr['prefix'])):
			$arr['prefix'] = '';
		endif;

		foreach ($arr['route'] as $key => $v):
			if($v['name'] == ''):
				var_dump($arr['class'], $arr['action'], $v);
				$name = sprintf("%s_%s", str_replace("Controller", "", $arr['class']), str_replace("Action", "", $arr['action']));
				$name = strtolower($name);
			else:
				$name = $v['name'];
			endif;

			$this->route[$v['name']] = array(
					'namespace' => $arr['namespace'],
					'class' 	=> $arr['class'],
					'prefix'	=> $arr['prefix'],
					'route'		=> $v['route'],
					'name'		=> $name,
					'action'	=> $arr['action'],
					'defaults'	=> (array_key_exists('defaults', $arr)) ? $arr['defaults'] : null,
					'method'	=> (array_key_exists('method', $arr)) ? $arr['method'] : null,
					'http'		=> (array_key_exists('http', $arr)) ? $arr['http'] : null,
					'regex'		=> (array_key_exists('regex', $arr)) ? $arr['regex'] : null,
			);
		endforeach;


	}

	protected function clearFile($file ){
		return preg_match("/namespace|function|class|@Route|@Prefix|@Defaults|@Method|@Http|@Regex/", $file);
	}

	protected function getNamespace($line){
		$line = trim($line);
		if(preg_match("/namespace +([\w\S]+) *?;/", $line, $mat)):
			return $mat[1];
		endif;
		return false;
	}

	protected function getClassName($line){
		$line = trim($line);
		if(preg_match("/class +(\S+)/", $line, $mat)):
			return $mat[1];
		endif;
		return false;
	}
	protected function getRouter($line){
		$line = trim($line);
		if(preg_match("/\* *?@[Rr]oute\( *?[\"\'](\S+)[\"\']\)?([\s,]*?name=[\"\'](\S+)[\"\']\))?/", $line, $mat)):
			return array("route" => $mat[1], "name"=> (isset($mat[3])) ? $mat[3] : "" );
		endif;
		return false;
	}

	protected function getFunction($line){
		$line = trim($line);
		if (preg_match("/^public +function +(\S+Action)/", $line, $mat)):
			return $mat[1];
		endif;
		return false;
	}

	protected function getPrefix($line){
		$line = trim($line);
		if (preg_match("/\* *?@[Pp]refix\([\"\'](\S+)[\'\"]\)/", $line, $mat)):
			return $mat[1];
		endif;
		return false;
	}

	protected function getMethod($line){
		$line = trim($line);
		if (preg_match("/\* *?@[Mm]ethod\([\"\'](\S+)[\'\"]\)/", $line, $mat)):
			return $mat[1];
		endif;
		return false;
	}	

	protected function getHttp($line){
		$line = trim($line);
		if (preg_match("/\* *?@[Hh]ttp\([\"\'](\S+)[\'\"]\)/", $line, $mat)):
			return $mat[1];
		endif;
		return false;
	}	
	protected function getDefaults($line){
		$line = trim($line);
		if (preg_match("/\* *?@[Dd]efaults\((\S+)\)/", $line, $mat)):
			return $mat[1];
		endif;
		return false;
	}
	protected function getRegex($line){
		$line = trim($line);
		if (preg_match("/\* *?@[Rr]egex\((\S+)\)/", $line, $mat)):
			return $mat[1];
		endif;
		return false;
	}	

	public function getRoute(){
		return $this->route;
	}
}