<?php 

namespace Plunder\Form;

use Plunder\Helpers\Plunder;
use Plunder\Core\Container\Container;
use Plunder\Core\HttpRequest\Request;
/**
* Class Form
*/
class Form 
{
	protected $formType		= array();
	protected $data;
	protected $builder;

	public function __construct(AbstractFormType $formType, $data) {
		$this->data 	= $data;
		$this->formType = $formType;
		$className 		= $formType->getOptions('className');
		$name 			= $formType->getOptions('name');
		
		if (!$data instanceof $className):
			throw new \Exception("Form Type não é um a instancia de " . $type->getOptions("className"), 1);
		endif;

		$this->builder = new BuilderForm($data, $name);
		$formType->buildForm($this->builder, array('data'=>$data));

		return $this;
	}

	public function createView(){
		//var_dump();
		return $this->builder->getFields();

	}

	public function handleRequest(Request $request){
		$data 		= $this->data;
		$mapName 	= $data::TABLE_MAP;

		if (Container::get($mapName) instanceof $mapName):
			$map = Container::get($mapName);
		else:
			$map = new $mapName;
			Container::load($mapName, $map);
		endif;

		$form 		= $request->request->get($this->formType->getOptions('name'));
		$fields		= $this->builder->getFields();

		if(count(array_diff_key($form, $fields))):
			throw new \Exception("Quantidade de campos definida no type deve ser igual a quantidade de campos enviadas pelo formulário", 500);
		endif;
		foreach ($form as $key => $value):
			if ($map->hasColumn($key)):
				$set = "set" . $map->getColumn($key)->getPhpName();
				$data->$set($value);
			endif;
		endforeach;



	}


}