<?php
namespace Plunder\Core\Form;
/**
* Abstract Type
*/
abstract class AbstractType 
{
	protected $form 		= array();
	protected $formName;
	protected $field;
	protected $options 		= array();

	public function __construct($formName, $field, $options = array()){
		$this->formName = $formName;
		$this->field 	= $field;
		$this->options  = $options;

		$this->buildField();
		return $this;
	}
	

	public function getForm(){
		if (!array_key_exists('value', $this->form)):
			throw new \Exception("Opção value não informada no campo " . $this->field, 500);
		endif;
			
		return $this->form;
	}	

	protected function getDefaultOptions($option = array()){
		$opt =  array(
				'field'			=> $this->field,
				'name'			=> sprintf("%s[%s]", $this->formName, $this->field),
				'type'			=> $this->getFieldType(),
				'input_type'	=> $this->getInputType(),
				'attr'			=> array(),
				'label'			=> $this->labelName($this->field),
				'id'			=> sprintf("%s_%s", $this->formName, $this->field),
				'error'			=> array(),
		);
		$opt = $option + $opt;
		return $this->options + $opt;
	}

	/**
	 * Method labelName
	 * Atraves do nome do campo gera um label
	 */
	protected function labelName($name){
		$aux = explode("_", $name);
		$aux = array_map("ucfirst",$aux);
		return implode(" ", $aux);
	}	
	public function set($key, $val){
		$this->form[$key] = $val;
		return $this;
	}

	public function setAttr($key, $val){
		$this->form['attr'][$key] = $val;
		return $this;
	}
	public function setError($value){
		$this->form['error'][] = $value;
		return $this;
	}

	public function get($key){
		return $this->form[$key];
	}

	public function has($key){
		return array_key_exists($key, $this->form);
	}
}