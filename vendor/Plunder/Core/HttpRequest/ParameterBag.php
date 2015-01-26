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
	public function get($value, $default=null, $security = true){
		
		if(array_key_exists($value, $this->parameter)):
			if (is_array($this->parameter[$value])):
				return $this->parameter[$value];
			else:
				return ($security) ? htmlentities($this->parameter[$value], ENT_QUOTES, "UTF-8") : $this->parameter[$value];
			endif;
		else:
			return $default;
		endif;
	}

	public function getAll(){
		return $parameter;
	}
}