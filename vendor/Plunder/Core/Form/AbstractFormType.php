<?php

namespace Plunder\Core\Form;

/**
* Abstract Form type
*/
class AbstractFormType
{
	protected $data;
	protected $form;
	protected $formView;

	public function __construct($data){
		$this->data = $data;
		$this->buildForm();
	}


	public function isValid(){
		
		$rules = $this->data->getRules();
		$this->createView();
		$form = $this->form;
		//$x = new NotBlank();
		$isValid = true;
		foreach ($rules as $key => $value):
			$campo = $form[$key];
			foreach ($value as $k => $v):
				$class = sprintf("Plunder\Core\Validation\Rules\%s", $k);
				$class = new $class($campo->get('value'), $campo->get('field'), $v);

				if(true !== $error = $class->validate()):
					$campo->setError($error);
					$isValid = false;
				endif;
			endforeach;			
		endforeach;
		//var_dump($form);
		return $isValid;

	}	
}