<?php

namespace Admin\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Request;
use Plunder\Core\HttpRequest\Response;
use Table\Model\PostQuery;
use Table\Model\Menu;
use Table\Model\MenuQuery;
use Table\Model\MenuItemQuery;


/**
* @Prefix("/admin/menu") 
*/
class MenuController extends Controller
{
	
	/**
	 * @Route("/teste", name="menu_teste")
	 */
	public function insertAction(){
		return new Response(print_r(json_decode($_POST['data']), true));
	}

	/**
	 * @Route("/create-menu", name="menu_create")
	 * @Method("POST");
	 */
	public function createAction(Request $req){
		$erro = array();
		if(strlen($req->post->pull("nome_menu")) == 0):
			$erro['erro']['nome'] =array("Este campo não deve ser vazio");
		endif;
		//var_dump($req->post->pull("add_auto"));
		$menu = new Menu();
		if($erro == array()):
			$menu->setNome($req->post->pull("nome_menu"));
			$menu->setPrincipal($req->post->pull("principal"));
			$options = array(
				"add_auto"=> ($req->post->pull("add_auto") == null) ? false : true,
			);
			$menu->setDados(json_encode($options));
			$menu->save();
			return new Response($menu->toJSON());
		else:
			return new Response(json_encode($erro), 200);
		endif;
		
	}


	/**
	 * @Route("/add-item", name="menu_add_item")
	 */
	public function addItemAction(Request $request){
		$post =  $_POST;
		$resposta = "";

		if ($post['type'] == 'page'):
			foreach ($post['posts'] as $key => $value):
				$item = new MenuItem();
				
			endforeach;
		endif;

		

		return new Response(print_r($post, true));
	}
	
	/**
	* @Route("/{id}", name="menu_home")
	* @Defaults({"id":""})
	*/
	public function indexAction($id){
		$post = PostQuery::create()->limit(10)->find();
		// Se id é nulo, tenta achar o menu principal;
		if ($id == ""):
			$menu = MenuQuery::create()->filterBy("Principal", '1')->findOne();
			//Se não encontrar o principal, procura o primeiro menu;
			if($menu == null):
				$menu = MenuQuery::create()->findOne();
			endif;
		else:
			//Se id for 0, é para criar um novo menu, então retorna null;
			if($id == "menu-0"):
				$menu = null;
			else:
				//Editar um menu existente;
				$menu = MenuQuery::create()->findPK($id);
			endif;
		endif;
		
		return $this->render("Admin:Menu:index.html.twig", array('post'=>$post, 'menu'=>$menu));
	}

}