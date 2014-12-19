<?php

namespace Admin\Controller;

use Plunder\Core\HttpRequest\Request;
use Table\Model\ClienteQuery;
/**
* @Route("/") 
*/
class AdminController
{
	/**
	 * @Route("/", name="admin_home")
	 */
	public function indexAction(){
		echo "Entrei no Admin / Homsesssadsadssadssasssss";
	}

	/**
	 * @Route("/news/{page}", name="admin_new", defaults={"page":1}, requirements={"page":"\d*"})
	 */
	public function newAction($page, Request $request){
		echo "Entrei no Admin / New " . $page;
		$cliente = ClienteQuery::create()->find();
		foreach ($cliente as $key => $value) {
			echo $value->getRazaoSocial() . " - " . $value->getContato();
		}
		//var_dump($request);
	}

	/**
	 * @Route("/update/{id}/{user}", name="admin_new", requirements={"id":"\d+"} defaults={"user":"palex"})
	 */
	public function updateAction($id){
		echo "Entrei no Admin / New";
	}


}