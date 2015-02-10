<?php 

namespace Plunder\Core\Form\Type;
use Plunder\Core\Form\AbstractType;

/**
* Check Type
*/
class Check extends AbstractType
{
	
	public function getForm(){
		if(!array_key_exists("checked", $this->form)):
			throw new \Exception("Opcao checked nao informada para o campo checkbox " . $this->field, 500);
		endif;

		return parent::getForm();
	}

	protected function buildField(){
		$opt 		= $this->getDefaultOptions();
		$this->form = $opt;
	}

	protected function getFieldType(){
		return 'check';
	}

	protected function getInputType(){
		return null;
	}



}