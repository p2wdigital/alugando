<?php

namespace Admin\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Request;
use Plunder\Core\HttpRequest\Response;

use Table\Model\Categoria;
use Table\Model\CategoriaQuery;

use Admin\Form\CategoriaForm;
/**
* @Prefix("/admin/categoria") 
*/
class CategoriaController extends Controller
{

	/**
	 * @Route("/", name="categoria_home")
	 */
	public function indexAction(){
		$categoria 	= new Categoria;
		$form 		= new CategoriaForm($categoria);

		if ($this->request->getMethod() == "POST"):
			$form->handleRequest();
			if($form->isValid()):
				$categoria->save();
				return $this->redirect($this->generateUrl('categoria_home'));
			endif;
		endif;

		$cat 		= CategoriaQuery::create()->find();
		return $this->render("Admin:Categoria:index.html.twig", array('form'=>$form->createView(), 'categoria'=>$cat));
	}

	/**
	 * @Route("/insert-ajax", name="categoria_insert_ajax")
	 * @Method("POST")
	 */
	public function insertAjaxAction(Request $request){
		$categoria = new Categoria;
		if($request->getMethod() != "POST"):
			return new Response("Requisição Inválida", 400);
		endif;			
		$nome 	= trim($request->request->get('cate')->get('nome'));
		$url 	= strtolower(str_replace(" ", "-", $nome));

		if (strlen(trim($nome)) == 0):
			return  new Response("Nome da categoria deve ser preenchido", 400);
		endif;
		$categoria->setNome($nome);
		$categoria->setUrl($url);
		
		$response = new Response();
		if($categoria->save()):
			$response->setContent($categoria->toJSON());
			$response->setContentType("application/json");
			return $response;
		else:
			$response->setContent("Erro ao salvar o registro! Contate o administrador");
			$response->setStatusCode(400);
			return $response;
		endif;

	}

	/**
	 * @Route("/update/{id}", name="categoria_update")
	 * @Regex({"id":"\d"})
	 */
	public function updateAction($id){
		
		$categoria	= CategoriaQuery::create()->findPK($id);
		$form 		= new CategoriaForm($categoria);

		if ($this->request->getMethod() == "POST"):
			$form->handleRequest();
			if($form->isValid()):
				$categoria->save();
				return $this->redirect($this->generateUrl('categoria_home'));
			endif;
		endif;

		return $this->render("Admin:Categoria:update.html.twig", array('form'=>$form->createView()));
	}

	/**
	 * @Route("/delete/{id}", name="categoria_delete")
	 * @Regex({"id":"\d"})
	 */
	public function deleteAction($id){
		
		if ((int) $id == 1):
			return new Response("Não é permitido deletar esta categoria", 400);
		endif;
		if (!$this->request->isAjax()):
			return new Response("Operação Não permitida", 400);
		endif;

		$categoria	= CategoriaQuery::create()->filterById($id)->delete();
		
		if ($categoria):
			return new Response("OK", 200);
		else:
			return new Response("Não foi possivel deletar esta categoria", 400);
		endif;
	}



}