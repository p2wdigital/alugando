<?php

namespace Plunder\Form;
/**
* 
*/
class BuilderForm 
{
	protected $fields		= array();



	public function add($name, $type, $options = array()){
		$this->fields[] = array("name"=>$name, "type"=>$type, "options"=>$options);
	}

	public function getFields(){
		return $this->fields;
	}
	
}