<?php 

namespace Plunder\Core\Validation;
/**
* Abstract Validation
*/
abstract class AbstractValidation
{
	protected $value;
	protected $options;
	protected $name;

	public function __construct($value, $name, $options = array()){
		$this->value 	= $value;
		$this->name 	= $name;
		$this->options 	= $options;	
	}

}