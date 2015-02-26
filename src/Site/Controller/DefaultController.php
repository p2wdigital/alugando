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

}