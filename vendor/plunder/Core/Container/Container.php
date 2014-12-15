<?php

namespace Plunder\Core\Container;
use Symfony\Component\Yaml\Parser;
/**
* 
*/
class Container 
{
	public  static $container = array();
	protected static $config	= array();
	/**
	 * [__construct Converte o arquivo de services .yaml em array e 
	 * armazena na variavel estatica ]
	 * @param Parser $yaml [Instancia do YAML Parser]
	 */
	public function __construct(Parser $yaml){
		self::$config = $yaml->parse(file_get_contents(__DIR__ . '\services.yaml'))['services'];
	}

	public static function load($key, $class){

	}
	/**
	 * [get Retorna uma instancia da classe]
	 * @param  [string] $key     [Apelido da classe]
	 * @param  boolean  $destroy [Criar nova instancia]
	 * @return [mixed]           [object or null]
	 */
	public static function get($key, $destroy = false){
		$container 	= self::$container;
		$config 	= self::$config;
		
		if ($destroy == true) unset($container[$key]);
		if (array_key_exists($key, $container)) return $container[$key];
		if (!array_key_exists($key, $config)) return null;
		
		$methodAux = array_flip(get_class_methods($config[$key]["class"]));
		//var_dump($methodAux);
		
		// Se não foi incluido parametros nas configurações ou a class
		// não possui um method construct retorna uma nova instancia da classe
		if ($config[$key]['params'] == null || !array_key_exists("__construct", $methodAux)):
			return self::$container[$key] = new $config[$key]["class"];
		endif;

		
		$method = new \ReflectionMethod($config[$key]["class"], '__construct');
		$parameters = $method->getParameters();
		$param = array();
		
		foreach ($parameters as $value):
			if(array_key_exists($value->name, self::$config[$key]['params'])):
				$aux = self::$config[$key]['params'][$value->name];
				if(strpos($aux, "%") !== false):
					$param[] = self::get(str_replace("%", "", $aux));
				else:
					$param[] = $aux;

				endif;
			endif;
		endforeach;
		$rc = new \ReflectionClass($config[$key]["class"]);
		$newClass = $rc->newInstanceArgs($param);
		return self::$container[$key] = $newClass;
		

		/*var_dump(self::$config[$key]);
		var_dump($method->getParameters());
		var_dump(get_class_methods($method->getParameters()[0]));
		var_dump(get_class_methods($method));
		*/


	}
}