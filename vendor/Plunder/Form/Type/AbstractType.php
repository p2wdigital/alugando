<?php 

namespace Plunder\Form\Type;

use Plunder\Core\Container\Container;
/**
* Abstract Type Class
*/
class AbstractType
{
	protected $name;
	protected $field;
	protected $data;
	protected $options;
	protected $mensagem;

	public function __construct($name, $field, $data, $option = array() ){
		$this->name 	= $name;
		$this->field 	= $field;
		$this->data 	= $data;
		$this->options 	= $option;
		$this->validate();
	}	

	/**
	 * [validate Verifica os campos obrigatórios]
	 * @param  [type] $options [description]
	 * @return [type]          [description]
	 */
	public function validate(){
		$options = $this->options;

		if(!is_array($options)):
			$this->mensagem = "Options não é uma array!";
			return false;
		endif;

		$list 	= $this->validateList();

		foreach ($list as $key => $value):
			if(!array_key_exists($value, $options)):
				throw new \Exception("Required option not found - Option: ". $value, 500);
			endif;
		endforeach;

		return true;
	}	

	protected function getValue(){
		$data	 	= $this->data;
		$mapName	= $data::TABLE_MAP;
		if (Container::get($mapName) instanceof $mapName):
			$map = Container::get($mapName);
		else:
			$map = new $mapName;
			Container::load($mapName, $map);
		endif;
		if ($map->hasColumn($this->field)):
			$get = "get" . $map->getColumn($this->field)->getPhpName();
			return $data->$get();
		endif;

	}

	protected function labelName($name){
		$aux = explode("_", $name);
		$aux = array_map("ucfirst",$aux);
		return implode(" ", $aux);
	}


}