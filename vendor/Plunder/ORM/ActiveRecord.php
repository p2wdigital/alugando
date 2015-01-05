<?php 

namespace Plunder\ORM;
use Plunder\ORM\Connect;

/**
* 
*/
abstract class ActiveRecord 
{
	
	public function save(){

		$this->saveAddRelations();

		$columns  = array_unique($this->modColumns);
		$bind 	  = array_map(function($var){
			return ":" .$var;
		}, $columns);

		$db = Connect::create();

		$query = sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->tableName, implode(", ", $columns), implode(", ", $bind));
		$smtp = $db->prepare($query);
		var_dump($query);
		foreach ($bind as $key => $value):
			$smtp->bindValue($value, $this->$columns[$key]);
		endforeach;
		if(!$smtp->execute()):
			//var_dump($smtp->errorInfo());
			//var_dump($smtp->errorCode());
			throw new \Exception("Erro ao inserir na base de dados:\n" . $db->errorInfo(), $db->errorCode());
			
		endif;

		foreach ($this->getAutoIncrement() as $key => $value):
			$this->$value = $db->lastInsertId($value);
		endforeach;
		
		$this->saveRelations();
		return $this;
	}

	public function saveAddRelations(){
		$relations  = array_unique($this->addRelations);

		foreach ($relations as $key => $value):
			$rel = "a".$value;
			$this->$rel = $this->$rel->save();
			var_dump($this->$rel);
			foreach ($this->getMapRelations($value) as $key => $param):
				$get = "get" . $this->$rel->getCamelFromName($key);
				$this->$param = $this->$rel->$get();
				$this->modColumns[] = $param;
			endforeach;
			//var_dump($this->$rel->save());
		endforeach;

	}

	public function saveRelations(){
		$relations  = array_unique($this->modRelations);

		foreach ($relations as $key => $value):
			$rel = "a".$value;
			//var_dump($this->$rel);
			foreach ($this->getMapRelations($value) as $key => $param):
				$set = "set" . $this->$rel->getCamelFromName($key);
				$this->$rel->$set($this->$param);
			endforeach;
			var_dump($this->$rel->save());
		endforeach;

	}

	protected function getNameFromCamel($camel){
		$columns = $this->getColumnsMap();
		if (!array_key_exists($camel, $columns)):
			var_dump($columns, $camel, $this->className);
			throw new \Exception("Problemas no Columns Map \n function getNameFromCamel", 358);
		endif;
		return $columns[$camel];
	}

	protected function getCamelFromName($name){
		$columns = array_flip($this->getColumnsMap());
		if (!array_key_exists($name, $columns)):
			var_dump($columns, $name, $this->className);
			throw new \Exception("Problemas no Columns Map \n function getCamelFromName", 358);
		endif;
		return $columns[$name];
	}

}