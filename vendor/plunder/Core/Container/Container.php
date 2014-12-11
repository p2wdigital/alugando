<?php

namespace Plunder\Core\Container;
use Symfony\Component\Yaml\Parser;
/**
* 
*/
class Container 
{
	protected static $container = array();
	protected static $config	= array();

	public function __construct(Parser $yaml){
		
		self::$config = $yaml->parse(file_get_contents(__DIR__ . '\services.yaml'))['services'];
		var_dump(self::$config);

	}
	public static function load($key, $class){

	}
	/**
	 * [get Envia uma instancia da classe]
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


		$method = new \ReflectionMethod($config[$key]["class"], '__construct');
		//var_dump($config[$key]["params"]);
		if($method->getNumberOfParameters() ==0 && $config[$key]["params"] == null):

			return self::$container[$key] = new $config[$key]["class"];
		endif;


//		var_dump(get_class_methods($method));
//		var_dump($method->getNumberOfParameters());
	}
}