<?php 

namespace Plunder\Core\Form\Type;
use Plunder\Core\Form\AbstractType;

/**
* Select Type
*/
class Select extends AbstractType
{
	
	public function getForm(){
		if(!array_key_exists("data", $this->form)):
			throw new \Exception("Opcao data nao informada para o campo select " . $this->field, 500);
		endif;


		if($this->has("value") && $this->has("empty")):
		    $data = $this->get('data');
    	endif;

		return parent::getForm();
	}


	protected function buildField(){
		$opt 		= $this->getDefaultOptions();
		$opt['empty_value'] = null;
		$opt['empty_data']	= "";
		$this->form = $opt;
	}

	protected function getFieldType(){
		return 'select';
	}

	public function get($key){
		if ($key == 'value'):
			if ($this->form['value'] == $this->form['empty_data']):
				return null;
			endif;
		endif;

		return parent::get($key);
	}

	protected function getInputType(){
		return null;
	}



}