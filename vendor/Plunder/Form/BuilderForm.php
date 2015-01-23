<?php

namespace Plunder\Form;

use Plunder\Form\Type as Type;
/**
* Class BuilderForm;
*/
class BuilderForm 
{
	protected $fields		= array();
	protected $data;
	protected $formName;

	public function __construct($data, $name){
		$this->data 	= $data;
		$this->formName = $name;
	}

	public function add($name, $type, $options = array()){
		$class 	= sprintf("Plunder\Form\Type\%sType", ucfirst($type));
		$data 	= $this->data;

		$type 	= new $class($this->formName, $name, $data, $options);
		$this->fields[$name] = $type->getField();
	}

	public function getFields(){
		return $this->fields;
	}
	
}