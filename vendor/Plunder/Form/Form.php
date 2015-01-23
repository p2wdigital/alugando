<?php 

namespace Plunder\Form;

use Plunder\Helpers\Plunder;
/**
* Class Form
*/
class Form 
{
	protected $form 		= array();
	protected $builder;

	public function __construct(AbstractFormType $formType, $data) {
		$className 	= $formType->getOptions('className');
		$name 		= $formType->getOptions('name');
		
		if (!$data instanceof $className):
			throw new \Exception("Form Type não é um a instancia de " . $type->getOptions("className"), 1);
		endif;

		$this->builder = new BuilderForm($data, $name);
		$formType->buildForm($this->builder, array('data'=>$data));

		return $this;
	}

	public function createView(){
		return $this->builder->getFields();

	}


}