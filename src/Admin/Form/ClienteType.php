<?php 

namespace Admin\Form;

use Plunder\Form\AbstractFormType;
use Plunder\Form\BuilderForm;

/**
* Cliente Type
*/
class ClienteType extends AbstractFormType{
	
	public function __construct(){
		$this->options['className'] = "Table\Model\Cliente";
	}

	public function buildForm(BuilderForm $builder, array $option){
		$builder->add('razao_social', 'text', array(
			'label'=>'Nome',
		));
		$builder->add('contato', 'text');
		$builder->add('save', 'submit');
	}




}
