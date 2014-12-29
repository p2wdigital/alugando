<?php

namespace Admin\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Request;
//use Table\Model\ClienteQuery;
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
		 
		//$cliente = ClienteQuery::create()->select(array('RazaoSocial', 'Contato'))->find();
		//$cliente = array();
		
		$db = new \PDO('mysql:host=localhost;dbname=information_schema', "root", null);
		$db-> exec("SET CHARACTER SET utf8");
//		$result = $db->query("select * from produto");
//		$cliente = $result->fetchAll();
		$query = sprintf('select keyy.*, ref.CONSTRAINT_TYPE from 
						 KEY_COLUMN_USAGE as keyy left join TABLE_CONSTRAINTS as ref 
						 ON(keyy.CONSTRAINT_NAME = ref.constraint_name and keyy.CONSTRAINT_SCHEMA = ref.CONSTRAINT_SCHEMA and keyy.TABLE_NAME = ref.TABLE_NAME)  
						where keyy.CONSTRAINT_SCHEMA = "%s" 
						and (keyy.table_name = "%s" or keyy.REFERENCED_TABLE_NAME = "%s" ) ', 
						'wep2', "user", "user" );
		
		//$query = 'select * from TABLE_CONSTRAINTS';
		$result = $db->query($query);
		//var_dump(get_class_methods($db));
		//var_dump($db->errorInfo());

		var_dump($result->fetchAll());
		
		//var_dump($cliente);
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