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
	 * @Route("/new/{page}", name="admin_new", defaults={"page":1}, requirements={"page":"\d*"})
	 */
	public function newAction($id){
		echo "Entrei no Admin / New";
	}

	/**
	 * @Route("/update/{id}/{user}", name="admin_new", requirements={"id":"\d+"} defaults={"user":"palex"})
	 */
	public function newAction($id){
		echo "Entrei no Admin / New";
	}


}