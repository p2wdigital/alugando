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
	protected $data;
	protected $type;

	public function __construct(AbstractFormType $type, $data) {
		$className = $type->getOptions('className');
		
		if (!$data instanceof $className):
			throw new \Exception("Data type não é um a instancia de " . $type->getOptions("className"), 1);
		endif;

		$this->builder = new BuilderForm();
		$type->buildForm($this->builder, array('data'=>$data));
		$this->data = $data;
		$this->type = $type;
		return $this;
	}

	public function createView(){
		$fields = $this->builder->getFields();

		foreach ($fields as $key => $value):
			$get = 'get'. Plunder::phpName($value['name']);
			if (method_exists($this->data, $get)):
				$val = $this->data->$get();
			else:
				$val = $value['name'];
			endif;

			$this->form[$value['name']] = array('name'=>$value['name'], 'value'=> $val,'type'=>$value['type'], 'option'=>$value['options']);
		endforeach;

		return $this->form;
	}


}