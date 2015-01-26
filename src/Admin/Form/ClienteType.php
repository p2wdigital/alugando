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
		$builder->add('razao_social', 'text');
		$builder->add('contato', 'text');
		$builder->add('cep', 'number');
		$builder->add('decricao', 'textarea');
		$builder->add('save', 'submit');
	}




}
