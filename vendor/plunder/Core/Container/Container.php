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
		
		// Se não foi incluido parametros nas configurações
		// retorna uma nova instancia da classe
		if ($config[$key]['params'] == null || array_key_exists("__construct", $methodAux)):
			try {
				return self::$container[$key] = new $config[$key]["class"];
			} catch (\Exception $e) {
				//Em caso de erro tenta montar dinamicamente os parametros
			}
		endif;


		//var_dump($methodAux);
		if($x):
			$method = new \ReflectionMethod($config[$key]["class"], '__construct');
			
			if($method->getNumberOfParameters() ==0 && $config[$key]["params"] == null):
				return self::$container[$key] = new $config[$key]["class"];
			endif;
		else:
			return self::$container[$key] = new $config[$key]["class"];
		endif;


//		var_dump(get_class_methods($method));
//		var_dump($method->getNumberOfParameters());
	}
}