<?php 

namespace Plunder\Core\Form\Type;
use Plunder\Core\Form\AbstractType;

/**
* TextType
*/
class TextArea extends AbstractType
{
	protected $form 		= array();
	protected $formName;
	protected $field;
	

	protected function buildField(){
		$opt 		= $this->getDefaultOptions();
		$this->form = $opt;
	}

	protected function getFieldType(){
		return 'textarea';
	}

	protected function getInputType(){
		return null;
	}


}