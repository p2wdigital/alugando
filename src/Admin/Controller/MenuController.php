<?php

namespace Admin\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Request;
use Plunder\Core\HttpRequest\Response;
use Table\Model\PostQuery;

/**
* @Route("/admin/menu", name="menu_home") 
*/
class MenuController extends Controller
{

	/**
	 * @Route("/", name="menu_home")
	 */
	public function indexAction(){
		$post = PostQuery::create()->limit(10)->find();
		return $this->render("Admin:Menu:index.html.twig", array('post'=>$post));
	}

	/**
	 * @Route("/teste", name="menu_teste")
	 */
	public function insertAction(){
		$arr = array(
			array('nome'=>'paulo', 'marca'=>'safra', "parent"=>array(
													'nome'=>'paulinho', 'marca'=>'jsafra'
				)),
			array('nome'=>'paulo2', 'marca'=>'safra2', "parent"=>array(
												array('nome'=>'paulinho2', 'marca'=>'jsafra2'),
												array("nome"=>'mais ', "marca"=>"outra"),
				)
			),
		);
		return new Response(print_r(json_decode($_POST['data']), true));
		//return new Response(print_r(json_encode($arr), true));

	}

	/**
	 * @Route("/update/{id}/{user}", name="admin_new", requirements={"id":"\d+"} defaults={"user":"palex"})
	 */
	public function updateAction($user, $id ){
	}


}