<?php

namespace Admin\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Request;

use Table\Model\Post;
use Table\Model\PostQuery;
use Table\Model\CategoriaQuery;
use Plunder\Core\Form\Type;

use Admin\Form\PostForm;


/**
* @Prefix("/admin/post") 
*/
class PostController extends Controller
{

	/**
	 * @Route("/", name="post_home")
	 */
	public function indexAction(){
		$post = PostQuery::create()->find();		
		return $this->render("Admin:Post:index.html.twig", array('post'=>$post));
	}

	/**
	 * @Route("/insert", name="post_insert")
	 */
	public function insertAction(Request $request){
		$type = $request->query->get('type', 'post');

		$post = new Post;
		$form = new PostForm($post);

		if ($request->getMethod() == "POST"):
			$form->handleRequest($this->request);
			if($form->isValid()):
				$post->save();
				return $this->redirect($this->generateUrl("post_update", array("id"=>$post->getId())));
			endif;
		endif;

		return $this->render("Admin:Post:insert.html.twig", array('form'=>$form->createView()));
	}

	/**
	 * @Route("/update/{id}", name="post_update")
	 * @Regex({"id":"\d"})
	 */
	public function updateAction($id){
		$post = PostQuery::create()->findPK($id);
		$form = new PostForm($post);

		if ($this->request->getMethod() == "POST"):
			$form->handleRequest($this->request);
			if($form->isValid()):
				$post->save();
			endif;
		endif;		

		return $this->render("Admin:Post:insert.html.twig", array('form'=>$form->createView()));

	}

	/**
	 * @Route("/server/{id}/{categoria}", name="post_server")
	 * @Defaults({"id":"10","categoria":"teste"})
	 */
	public function serverAction($id, $categoria){
		var_dump($_SERVER, $id, $categoria);
		//$path = $_SERVER['SCRIPT_FILENAME'];
		$path = $_SERVER['SCRIPT_NAME'];
		var_dump(realpath($path), basename($path), dirname($path), pathinfo($path));

		echo sprintf("<a href='%s'>%s</a>", $this->request->getBaseFile() . "/assert/css/style.css","Link");
	}
}