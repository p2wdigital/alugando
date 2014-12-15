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
		echo "Entrei no Admin / Homsesssadsadssadssasssss";
	}

	/**
	 * @Route("/new/{id}", name="admin_new")
	 */
	public function newAction($id){
		echo "Entrei no Admin / New";
	}

}