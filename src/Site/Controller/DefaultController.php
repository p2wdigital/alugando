<?php 

namespace Site\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Response;

/**
* @Prefix("")
*/
class DefaultController extends Controller{
	
	/**
	 * @Route("/", name="site_home")
	 */
	public function homeAction(){
		
		return $this->render("Site:Default:home.html.twig");
	}
	/**
	 * @Route("/empresa", name="site_empresa")
	 */
	public function empresaAction(){
		return $this->render("Site:Default:empresa.html.twig");
	}

}