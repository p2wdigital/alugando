<?php 

namespace Plunder\Form\Type;

/**
* Class TextType
*/
class Text extends AbstractType implements TypeInterface
{

	/**
	 * [validateList Um array com todas as opções obrigatorias para o tipo
	 * de campo]
	 * @return [array] [Lista opções]
	 */
	protected function validateList(){
		return array(
			''
		);
	}
	
}
