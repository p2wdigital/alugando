<?php 

namespace Admin\Form;

use Plunder\Form\AbstractFormType;
use Plunder\Form\BuilderForm;

/**
* Cliente Type
*/
class ClienteType extends AbstractFormType{
	
	public function __construct(){
		$this->options = array(
			"className" => "Table\Model\Cliente",
			"name"		=> "cliente",
		);

	}

	public function buildForm(BuilderForm $builder, array $option){
		$builder->add('razao_social', 'text', array(
			'label'=>'Nome',
			'attr'=>array("class"=>"oal"),
		));
		$builder->add('contato', 'text');
		$builder->add('save', 'text');
	}




}
