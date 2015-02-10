<?php 

namespace Plunder\Core\Form\Type;
use Plunder\Core\Form\AbstractType;

/**
* TextType
*/
class Hidden extends AbstractType
{
	protected function buildField(){
		$opt 		= $this->getDefaultOptions();
		$opt['nolabel'] = true;
		$this->form = $opt;
	}

	protected function getFieldType(){
		return 'input';
	}

	protected function getInputType(){
		return 'hidden';
	}



}