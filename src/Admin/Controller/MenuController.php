<?php

namespace Admin\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Request;
use Table\Model\PostQuery;

/**
* @Route("/admin/menu") 
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
	 * @Route("/insert", name="admin_insert")
	 */
	public function insertAction(Request $request){
	}

	/**
	 * @Route("/update/{id}/{user}", name="admin_new", requirements={"id":"\d+"} defaults={"user":"palex"})
	 */
	public function updateAction($user, $id ){
	}


}