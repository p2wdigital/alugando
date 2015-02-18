<?php

namespace Admin\Form;

use Plunder\Core\Form\Type;
use Plunder\Core\Form\AbstractFormType;
use Table\Model\Categoria;
use Table\Model\CategoriaQuery;
use Table\Model\PostHasCategoria;
use Propel\Runtime\Collection\ObjectCollection;



use Plunder\Core\Validation\Rules as Rule;

/**
* Post Type
*/
class PostForm extends AbstractFormType
{


	protected function buildForm(){
		$form = array();

		$type = new Type\Text("post", "titulo"); 
		$form['titulo'] = $type->set('label', 'Título');
						

		$type = new Type\Textarea("post", 'text');
		$form['text'] = $type->set('nolabel', true);
		
		$type = new Type\Hidden('post', 'tipo');
		$form['tipo'] = $type;

		$type = new Type\Select('post', 'status');
		$form['status'] = $type->set('empty_data','---')->set('empty_value', 0)->set('data', $this->data->getListStatus());

		$type = new Type\Hidden('post', 'url');
		$form['url'] = $type->set('nolabel', true);
		

		$cat = CategoriaQuery::create()->find();
		
		$categoria = array();
		foreach ($cat as $key => $value):	
			$type = new Type\Check('categoria', 'id');
			$categoria[$key]['id'] = $type->set('name', sprintf("categoria[][%s]", 'id'))
								->set('label', $value->getNome())->set('value', $value->getId());
		endforeach;

		$form['categoria'] = $categoria;
		$this->form = $form;
	}


	public function createView(){
		$data = $this->data;
		$form = $this->form;

		$form['titulo'] 	= $form['titulo']->set("value", $data->getTitulo())->getForm();
		$form['text'] 		= $form['text']->set("value", $data->getText())->getForm();
		$form['tipo'] 		= $form['tipo']->set("value", $data->getTipo())->getForm();
		$form['status'] 	= $form['status']->set("value", $data->getStatus())->getForm();
		$form['url'] 		= $form['url']->set("value", $data->getUrl())->getForm();

		$catAux = array();
		foreach ($data->getPostHasCategorias() as $key => $value):
			$catAux[$value->getCategoriaId()] = $value->getCategoriaId();
		endforeach;

		foreach ($form['categoria'] as $key => $value):
			$form['categoria'][$key]['id'] = $value['id']->set('checked', array_key_exists($value['id']->get('value'), $catAux))
											->getForm();
		endforeach;
		usort($form['categoria'], function($a, $b){
			return $a['id']['checked'] < $b['id']['checked'] ;
		});
		return $this->formView = $form;
	}


	public function handleRequest(){
		$data = $this->data;
		$post = $_POST['post'];
		
		$data->setTitulo($post['titulo']);
		$data->setText($post['text']);
		$data->setTipo("post");
		$data->setStatus($post['status']);
		$data->setUrl($post['url']);

		$obj = new ObjectCollection();
		$obj->setModel('\Table\Model\PostHasCategoria');
		
		
		foreach ((isset($_POST['categoria'])) ? $_POST['categoria'] : array() as $key => $value):
			$cate = new PostHasCategoria();
			$cate->setNew(false);
			$cate->setCategoriaId($value["id"]);
			$cate->setPostId($data->getId());
			if(!$data->getPostHasCategorias()->contains($cate)):
				$cate->setNew(true);
			endif;
			$obj->push($cate);
		endforeach;
		
		if(!isset($_POST['categoria'])):
			
			$cate = new PostHasCategoria();
			$cate->setCategoriaId(1);
			$cate->setPostId($data->getId());
			$obj->push($cate);
		endif;
		
		$col = $obj;
		$data->setPostHasCategorias($obj);
	}

}