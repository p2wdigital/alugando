<?php

namespace Plunder\Core\Config;

use Plunder\Helpers\Cache\Cache;
use Symfony\Component\Yaml\Parser;

/**
* Class Config
*/
class Config
{
	protected static $config;
	
	public function __construct(Parser $yaml, Cache $cache){
		if (ENVIRONMENT == 'prod'):
			$fileCache = 'plunder.config';
			if($cache->existsFile($fileCache)):
				self::$config = $cache->getCache($fileCache);
			else:
				self::$config = $yaml->parse(file_get_contents(BASE_DIR . '\app\config\config.yaml'));
				$cache->setCache($fileCache, self::$config);
			endif;
		else:
			self::$config = $yaml->parse(file_get_contents(BASE_DIR . '\app\config\config.yaml'));
		endif;
		return $this;		
	}

	public static function get($param){
		$aux = explode(".",$param);

		$config = self::$config;
		foreach ($aux as $key => $value):
			if (array_key_exists($value, $config)):
				$config = $config[$value];
			else:
				throw new \Exception("Parametro de Configuração não Existe " . $param  , 1);
				var_dump("continua");
			endif;
		endforeach;
		return $config;
	}

}