<?php


/**
* @Route("/admin") 
*/
class AdminController
{
	/**
	 * @Route("/", name="admin_home")
	 */
	public function indexAction(){
		echo "Entrei no Admin / Homesadsadsadssas";
	}

	/**
	 * @Route("/new", name="admin_new")
	 */
	public function newAction(){
		echo "Entrei no Admin / New";
	}

}