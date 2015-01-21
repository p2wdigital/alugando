<?php


namespace Plunder\ORM;
use Plunder\Core\Container\Container;
use Plunder\Core\Config\Config;
/**
* 
*/
class Connect
{
	protected static $db;
	
	private  function __construct(){
	}

	public static function create(){
		//Caso $db já seja uma instancia de PDO retorna;
		if (self::$db instanceof \PDO) return self::$db;

		//Monta DNS de conexão;
		$dns = sprintf("mysql:host=%s;dbname=%s", Config::get('plunder.database.host'), Config::get('plunder.database.db'));

		//Conecta com o banco de dados e set os caracters conformeConfiguração;
		self::$db = new \PDO($dns, Config::get('plunder.database.user'), Config::get('plunder.database.password'));
		self::$db->exec(sprintf("SET CHARACTER SET %s", strtolower(Config::get('plunder.encoding'))));

		return self::$db;
	}
}