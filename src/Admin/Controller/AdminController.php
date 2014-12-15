<?php

namespace Admin\Controller;
/**
* @Route("/") 
*/
class AdminController
{
	/**
	 * @Route("/", name="admin_home")
	 */
	public function indexAction(){
		echo "Entrei no Admin / Homsesssadsadsadssasssss";
	}

	/**
	 * @Route("/new", name="admin_new")
	 */
	public function newAction($id){
		echo "Entrei no Admin / New";
	}

}