<?php 

namespace Plunder\Core\Form\Type;
use Plunder\Core\Form\AbstractType;

/**
* TextType
*/
class Text extends AbstractType
{
	protected $form 		= array();
	protected $formName;
	protected $field;
	
	protected function buildField(){
		$opt 		= $this->getDefaultOptions();
		$this->form = $opt;
	}

	protected function getFieldType(){
		return 'input';
	}

	protected function getInputType(){
		return 'text';
	}



}