<?php 

namespace Plunder\Core\HttpRequest;
/**
 * Class Request 
 */
class Request
{
	/**
	 * [$query Valores de $_GET]
	 * @var array
	 */
	public $query 		= array();
	/**
	 * [$request Valores de $_POST]
	 * @var array
	 */
	public $post 		= array();
	/**
	 * [$server Valores de $_SERVER]
	 * @var array
	 */
	public $server 		= array();

	public function __construct(){
		$this->initialize($_GET, $_POST, $_SERVER);
		return $this;
	}

	public function initialize(array $get = array(), array $post = array(), array $server = array()){
		$this->query 	= 	new ParameterBag($get);
		$this->post  	= 	new ParameterBag($post);
		$this->server 	= 	new ParameterBag($server);
	}

	public function getRequest(){
		$this->post->toArray();
	}

	public function getPathInfo(){
		$path = $this->server->pull("PATH_INFO", "", false);
		if($path != "") return $path;
		
		$path = $this->server->pull("REQUEST_URI", "", false);
		$base = $this->server->pull("BASE", "", false);
		return str_replace($base, "", $path);
	}

	public function getBase(){
		$base = $this->server->pull("BASE");
		if ($base === null):
			preg_match("/^(.*)(\/\w+\.php).*/i", $this->server->pull('REQUEST_URI'), $match);
				return $match[1] . $match[2];
		endif;
		return $base;
	}

	public function getBaseFile(){
		
		$base = $this->server->pull("BASE");
		if ($base === null):
			preg_match("/^(.*)(\/\w+\.php).*/i", $this->server->pull('REQUEST_URI'), $match);
				return $match[1];
		endif;
		return $base;
	}

	public function getMethod(){
		return $this->server->pull("REQUEST_METHOD", 'GET');
	}

	public function isAjax(){
		return 'XMLHttpRequest' == $this->server->pull('HTTP_X_REQUESTED_WITH', null);
	}
}