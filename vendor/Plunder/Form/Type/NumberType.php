<?php 

namespace Plunder\Form\Type;
use Plunder\Helpers\Plunder;
/**
* Class NumberType
*/
class NumberType extends AbstractType implements TypeInterface
{

	/**
	 * [validateList Um array com todas as opções obrigatorias para o tipo
	 * de campo]
	 * @return [array] [Lista opções]
	 */
	public function validateList(){
		return array();
	}

	public function getName(){
		return "number";
	}
	
	public function getField(){
		$field 		= array();
		$options 	= $this->options;


		$field['form']		= $this->name;
		$field['name']		= sprintf("%s[%s]", $this->name, $this->field);
		$field['field'] 	= $this->field;
		$field['type']		= $this->getName();
		$field['input']		= true;
		$field['value'] 	= $this->getValue();
		
		if (!array_key_exists('label', $options)):
			$field['label'] = $this->labelName($this->field);
		endif;


		return $field = $field + $options;

	}
}
