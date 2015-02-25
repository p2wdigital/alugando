<?php 


namespace PLunder\Core\HttpRequest;
/**
* 
*/
class ParameterBag 
{
	private $parameter = array();

	/**
	 * [__construct Inicializa var $parameter]
	 * @param [type] $parameter [Array com valores]
	 */
	public function __construct($parameter){
		$this->parameter = $parameter;
		return $this;
	}

	/**
	 * [get Retorna dados do array]
	 * @param  [type]  $value    [Key a ser retornada]
	 * @param  [type]  $default  [Valor padrão caso não exista a key]
	 * @param  boolean $security [true: aplica htmlentities, false: retorna valor padrao]
	 * @return [type]            [Valor do array]
	 */
	public function pull($value, $default=null, $security = true){
		
		$aux = explode(".",trim($value));

		$parameter = $this->parameter;

		foreach ($aux as $key => $value):
		
			if(!is_array($parameter)) break;

			if (array_key_exists($value, $parameter)):
				$parameter = $parameter[$value];
			else:
				$parameter = $default;
			endif;
		endforeach;

		if (is_array($parameter)):
			return new ParameterBag($parameter);
		else:
			return ($security) ? htmlentities($parameter, ENT_QUOTES, "UTF-8") : $parameter;
		endif;
	}

	public function toArray(){
		return $this->parameter;
	}
}