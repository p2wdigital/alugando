<?php

namespace Admin\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Request;

/**
* @Route("/admin/menu") 
*/
class MenuController extends Controller
{

	/**
	 * @Route("/", name="admin_home")
	 */
	public function indexAction(){
		return $this->render("Admin:Admin:index.html.twig", array());
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