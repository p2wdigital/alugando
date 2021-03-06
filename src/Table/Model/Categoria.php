<?php

namespace Table\Model;

use Table\Model\Base\Categoria as BaseCategoria;

/**
 * Skeleton subclass for representing a row from the 'categoria' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Categoria extends BaseCategoria
{


	public function getRules(){
		$rules = array();

		$rules['nome'] 		= array('NotBlank'=>array());
		$rules['url']		= array('NotBlank'=>array());
		return $rules;
	}

}
