<?php

namespace Admin\Form;

use Plunder\Core\Form\Type;
use Plunder\Core\Form\AbstractFormType;

/**
* Categoria Form
*/
class CategoriaForm extends AbstractFormType
{
	

	public function buildForm()	{
		$form = array();

		$form['nome'] = new Type\Text("categoria", "nome"); 
		$form['url'] = new Type\Text("categoria", 'url');

		$type = new Type\Textarea("categoria", "descricao");
		$form['descricao'] = $type->set("label", 'Descrição')->setAttr('style', 'height:100px;');

		$this->form = $form;
	}

	public function createView(){
		$data = $this->data;
		$form = $this->form;

		$form['nome'] 		= $form['nome']->set('value', $data->getNome())->getForm();
		$form['url'] 		= $form['url']->set('value', $data->getUrl())->getForm();
		$form['descricao'] 	= $form['descricao']->set('value', $data->getDescricao())->getForm();

		return $this->formView = $form;
	}


	public function handleRequest(){
		$data = $this->data;
		$post = $_POST['categoria'];

		$data->setNome($post['nome']);
		$data->setUrl($post['url']);
		$data->setDescricao($post['descricao']);
	}




}