<?php 

namespace Plunder\Form\Type;

/**
* Abstract Type Class
*/
class ClassName extends AnotherClass
{
	protected $name;
	protected $field;
	protected $options;
	protected $mensagem;

	public function __construct($name, $field, $option = array()){
		$this->name 	= $name;
		$this->field 	= $field;
		$this->options 	= $options;
	}	

	/**
	 * [validate Verifica os campos obrigatórios]
	 * @param  [type] $options [description]
	 * @return [type]          [description]
	 */
	public function validate(){
		$options = $this->options;

		if(is_array($options)):
			$this->mensagem = "Options não é uma array!";
			return false;
		endif;

		

	}	
}