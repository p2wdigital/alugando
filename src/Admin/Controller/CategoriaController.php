<?php

namespace Admin\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Request;

use Plunder\Core\HttpRequest\Response;

use Table\Model\Post;
use Table\Model\PostQuery;

use Table\Model\Categoria;
use Table\Model\CategoriaQuery;
/**
* @Route("/admin/categoria") 
*/
class CategoriaController extends Controller
{

	/**
	 * @Route("/", name="categoria_home")
	 */
	public function indexAction(){
		echo 'oi';
		return $this->render("Admin:Post:index.html.twig", array());
	}

	/**
	 * @Route("/insert", name="categoria_insert")
	 */
	public function insertAction(Request $request){
		$post 		= new Post();
		$categoria 	= CategoriaQuery::create()->find();
		
		$type 		= $request->query->get('type', 'post');
		$form 		= $this->getForm($post, $type);
		return $this->render("Admin:Post:insert.html.twig", array('form'=>$form, 'categoria'=>$categoria));
	}
	/**
	 * @Route("/insert-ajax", name="categoria_insert_ajax")
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
	 * @Route("/update/{id}/{user}", name="admin_new", requirements={"id":"\d+"}, defaults={"user":"palex"})
	 */
	public function updateAction($user, $id ){
	}


	private function getForm($data, $type){
		$form = array();
		$form['titulo'] = array(
			'field'=>'titulo', 'name'=>'post[titulo]', 'type'=>'input',
			'input_type'=>'text', 'label'=>'Título', 'attr'=>array(),
			'value'=>$data->getTitulo(), 
		);
		$form['text'] = array(
			'field'=>'text', 'name'=>'post[text]', 'type'=>'textarea',
			'input_type'=>null, 'nolabel'=>true, 'attr'=>array(),
			'value'=>$data->getText()
		);
		$form['tipo'] = array(
			'field'=>'tipo', 'name'=>'post[tipo]', 'type'=>'input',
			'input_type'=>'hidden', 'nolabel'=>true,
			'value'=>$data->getTipo(),
		);

		$form['status'] = array(
			'field'=>'status', 'name'=>'post[status]', 'type'=>'select',
			'label'=>'Status','attr'=>array(),
			'data'=>$data->getListStatus(), 'default'=>0, 'empty'=>'------',
			'value'=>$data->getStatus(),
		);
		$form['url'] = array(
			'field'=>'url', 'name'=>'post[url]', 'type'=>'input',
			'input_type'=>'text',
			'value'=>$data->getUrl(),
		);

		return $form;


	}


}