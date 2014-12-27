<?php

namespace Admin\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Request;
use Table\Model\ClienteQuery;
use Plunder\Core\Container\Container;
/**
* @Route("/") 
*/
class AdminController extends Controller
{
	/**
	 * @Route("/", name="admin_home")
	 */
	public function indexAction(){
		 
		//$cliente = ClienteQuery::create()->find();
		$cliente = array();
		
		//$db = new \PDO('mysql:host=localhost;dbname=wep2', "root", null);
		//$result = $db->query("select * from cliente");
		//$cliente = $result->fetchAll();
		
		//var_dump(Container::$container);
		return $this->render("Admin:Admin:index.html.twig", array("cliente"=>$cliente));
		//echo "Hello Word";
	}

	/**
	 * @Route("/news/{page}", name="admin_new", defaults={"page":1}, requirements={"page":"\d*"})
	 */
	public function newAction($page, Request $request){
		echo "Entrei no Admin / New " . $page;
		/*$cliente = ClienteQuery::create()->find();
		foreach ($cliente as $key => $value) {
			echo $value->getRazaoSocial() . " - " . $value->getContato();
		}
		*/
		//var_dump($request);
	}

	/**
	 * @Route("/update/{id}/{user}", name="admin_new", requirements={"id":"\d+"} defaults={"user":"palex"})
	 */
	public function updateAction($id){
		echo "Entrei no Admin / New";
	}


}