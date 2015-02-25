<?php

namespace Table\Model;

use Table\Model\Base\Post as BasePost;

/**
 * Skeleton subclass for representing a row from the 'post' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Post extends BasePost
{

	public function getListStatus(){
		return array(
			1=>'Pendente de Revisão',
			2=>'Excluído',
			3=>'Rascunho',
			9=>'Publicado',
		);
	}


	public function getRules(){
		$rules = array();

		$rules['titulo'] 	= array('NotBlank'=>array());
		$rules['content']	= array('NotBlank'=>array());
		$rules['status']	= array('NotBlank'=>array());
		$rules['url']		= array('NotBlank'=>array());

		return $rules;
	}


}
