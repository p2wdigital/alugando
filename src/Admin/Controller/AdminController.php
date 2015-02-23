<?php

namespace Admin\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Request;

/**
* @Prefix("/admin") 
*/
class AdminController extends Controller
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

	public function update($user, $id ){
	}


}