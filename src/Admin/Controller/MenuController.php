<?php

namespace Admin\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Request;
use Plunder\Core\HttpRequest\Response;
use Table\Model\PostQuery;
use Table\Model\Menu;
use Table\Model\MenuQuery;


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
		$menu = MenuQuery::create()->filterBy("Principal", '1')->findOne();
		var_dump($menu);
			
		
		if ($menu == array()):
			$menu = MenuQuery::create()->findOne();
		endif;

		return $this->render("Admin:Menu:index.html.twig", array('post'=>$post, 'menus'=>$menu));
	}

	/**
	 * @Route("/teste", name="menu_teste")
	 */
	public function insertAction(){
		return new Response(print_r(json_decode($_POST['data']), true));
	}

	/**
	 * @Route("/create-menu", name="menu_create")
	 */
	public function createAction(Request $request){
		$nome = $request->request->get('nome');
		$menu = new Menu();
		$menu->setNome($nome);
		$menu->save();

		return new Response($menu->toJSON());
	}


	/**
	 * @Route("/add-item", name="menu_add_item")
	 */
	public function addItemAction(){
		var_dump($_POST);
	}

}