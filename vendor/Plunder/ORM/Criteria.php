<?php 

namespace Plunder\ORM;

/**
* Class Criteria
*/
class Criteria
{
	
	protected $select 	= array();
	protected $where	= array();
	protected $join		= array();

	private function __construct(){
	}

	public static function create(){
		return $this;
	}

	public function filterBy($name, $value){
		$colunm = $this->getColumnsMap()
	}

	//ClienteQuery::create()->filterByName('1');
	//ClienteQuery::create()->filterBy('id', '1');
	//ClienteQuery::create()->ordeByName('desc');
	//ClienteQuery::create()->orderBy('name', desc);
	//ClienteQuery::create()->limit(10,30);
	//ClienteQuery::create()->select(array(nome, empresa, contato));
	//ClienteQuery::create()->join('Category')
	//ClienteQuery::create()->join('Category')->on('')
}
