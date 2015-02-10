<?php

namespace Plunder\Core\Validation\Rules;
use Plunder\Core\Validation\AbstractValidation;
/**
* Rules NotBlank
*/
class NotBlank extends AbstractValidation
{
	
	public function __construct($value, $name, $options = array()){
		parent::__construct($value, $name, $options);
		
		$default = array(
			'msg'=>'O campo %s não pode ser vazio.'
		);

		$this->options = $options + $default;
	}


	public function validate(){
		$value = $this->value;
		if (false === $value || (empty($value) && '0' != $value)):
			return $this->error();
		else:
			return true;
		endif;
	}


	public function error(){
		
		return sprintf($this->options['msg'], $this->name);
	}


}