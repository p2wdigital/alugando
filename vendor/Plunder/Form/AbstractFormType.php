<?php 

namespace Plunder\Form;
/**
* Abstract Form Type
*/
class AbstractFormType
{
	protected $options = array();

	public function getOptions($key){
		if (isset($this->options[$key]))
			return $this->options[$key];

		return false;
	}



}