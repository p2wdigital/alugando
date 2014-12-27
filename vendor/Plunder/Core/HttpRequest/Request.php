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
	public $request 	= array();
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
		$this->request  = 	new ParameterBag($post);
		$this->server 	= 	new ParameterBag($server);
	}


	public function getPathInfo(){
		return $this->server->get("PATH_INFO", "", false);
	}
}