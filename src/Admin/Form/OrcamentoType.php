<?php 

namespace Admin\Form;

use Plunder\Form\AbstractFormType;
use Plunder\Form\BuilderForm;

/**
* Cliente Type
*/
class OrcamentoType extends AbstractFormType{
	
	public function __construct(){
		$this->options = array(
			"className" => "Table\Model\Orcamento",
			"name"		=> "orcamento",
		);

	}

	public function buildForm(BuilderForm $builder, array $option){
		$builder->add('prazo', 'text');
		$builder->add('data_inicio', 'text');
		$builder->add('data_fim', 'number');
		$builder->add('descricao', 'textarea');
		$builder->add('save', 'submit');
	}




}
