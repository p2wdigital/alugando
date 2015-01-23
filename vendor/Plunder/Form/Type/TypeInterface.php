<?php


namespace Plunder\Form\Type;

/**
* Interface Type
*/
interface TypeInterface{
	protected $name;
	protected $field;
	protected $options;

	public function __construct($name, $field, $options);
	/**
	 * [validate Valida os itens obrigatorios]
	 * @return [bool] [true | False]
	 */
	public function validateList();

	/**
	 * [getName Retorna o nome do tipo de campo]
	 * @return [string] [Nome do tipo]
	 */
	public function getName();

	/**
	 * [getForm Retorna um array com as informações de cada campo]
	 * @param  [type] $options [description]
	 * @return [type]          [description]
	 */
	public function getField($options);


}