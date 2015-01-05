<?php 

namespace Plunder\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\OutputInterface;
use Plunder\Core\Config\Config;

/**
* 
*/
class ReversePlunderCommand extends Command{
	protected $xml  = "";
	protected $line = "\n";
	protected $e2 	= "  ";
	protected $e4 	= "    ";
	protected $e6 	= "      ";

	protected function configure(){

		$this->setName("plunder:reverse");
		$this->setDescription("Reverse data base to XML based on config.yml");
	}


	protected function execute(InputInterface $input, OutputInterface $output){
		
		$arguments = array(
        	'command' => 'database:reverse',
        	'output-dir'=>"app/propel",
    	);
		$this->reverseSchema($arguments);
		$output->writeln("Database reverse: ok");

	}

	protected function reverseSchema($arg){
		$this->openXml();
		$dns = sprintf('mysql:host=%s;dbname=information_schema', Config::get("plunder.host"));
		$db = new \PDO($dns, Config::get("plunder.user"), Config::get("plunder.password"));

		$query = sprintf("Select * from columns where table_schema = '%s'", Config::get('plunder.database'));

		$result = $db->query($query);

		$table = "";
		foreach ($result->fetchAll() as $key => $value):
			if($table != $value['TABLE_NAME']):
				if($table != ""):
					$this->relationsTable($db, $table);
					$this->closeTable();
				endif;
				$this->openTable($value['TABLE_NAME']);
				$table = $value['TABLE_NAME'];
			endif;
			$this->column($value);


		endforeach;
		$this->relationsTable($db, $value['TABLE_NAME']);
		$this->closeTable();
		$this->closeXml();
	}


	protected function column($col){
		$column = array();
		$column['name'] 			= $col['COLUMN_NAME'];
		$column['phpName'] 			= $this->phpName($col['COLUMN_NAME']);
		$column['type']				= $this->parseType($col['DATA_TYPE']);

		if($col['COLUMN_KEY'] 		== "PRI") 				$column['primaryKey'] 		= "true";
		if($col['EXTRA'] 			== "auto_increment") 	$column['autoIncrement'] 	= "true";
		
		if($col['IS_NULLABLE'] 		== 'NO' && !array_key_exists('autoIncrement', $column)):
			$column['required']		= "true";
		endif;

		if ($column['type'] 		== "VARCHAR"):
			$column['size'] 		= $col['CHARACTER_MAXIMUM_LENGTH'];
		endif;

		if ($column['type'] 		== "DECIMAL"):
			$column['size'] 		= $col['NUMERIC_PRECISION'];
			$column['scale'] 		= $col['NUMERIC_SCALE'];
		endif;


		$val = $this->arrayToXml("column", $column);
		$this->xml .= $this->e4 . $val . $this->line;
	}

	protected function relationsTable($db, $table){

		$query = sprintf('select keyy.*, ref.CONSTRAINT_TYPE from 
						 KEY_COLUMN_USAGE as keyy left join TABLE_CONSTRAINTS as ref 
						 ON(keyy.CONSTRAINT_NAME = ref.constraint_name and keyy.CONSTRAINT_SCHEMA = ref.CONSTRAINT_SCHEMA and keyy.TABLE_NAME = ref.TABLE_NAME)  
						where keyy.CONSTRAINT_SCHEMA = "%s" 
						and (keyy.table_name = "%s" ) ', 
						config::get('plunder.database'), $table );
		$result = $db->query($query);

		$open 			= null;
		$primary 		= array();
		$relations 		= array();

		foreach ($result->fetchAll() as $key => $value):

			if ($value['CONSTRAINT_TYPE'] == "PRIMARY KEY"):
				$primary[] 	= array( 
							'table'=> $value['TABLE_NAME'],
							'column'=> $value['COLUMN_NAME']
				);
			endif;

			if ($value['CONSTRAINT_TYPE'] == "FOREIGN KEY"):
				$relations[] = array( 
							'table'				=> $value['TABLE_NAME'],
							'column'			=> $value['COLUMN_NAME'],
							'referenceTable'		=> $value['REFERENCED_TABLE_NAME'],
							'referenceColumn'	=> $value['REFERENCED_COLUMN_NAME']
				);
			endif;
		endforeach;

		if (count($relations) > 0) $this->openRelations();

		foreach ($relations as $key => $value):
			$xmlAux = array();

			if($value['referenceTable'] == $table):
				$xmlAux['type'] 	= 'OneToMany';
				$xmlAux['column']	= $value['referenceColumn'];
				$xmlAux['referenceTable']	= $value['table'];
				$xmlAux['referenceColumn']	= $value['column'];
				$this->xml .= $this->e6 . $this->arrayToXml('foreing-key', $xmlAux) .$this->line;
			endif;

			if($value['table'] == $table):
				if (count($primary) > 1):
					$xmlAux['type']		= 'ManyToOne';
				else:
					$xmlAux['type'] 	= 'OneToOne';
				endif;
				$xmlAux['column']	= $value['column'];
				$xmlAux['referenceTable']	= $value['referenceTable'];
				$xmlAux['referenceColumn']	= $value['referenceColumn'];
				$this->xml .= $this->e6 . $this->arrayToXml('foreing-key', $xmlAux) .$this->line;
			endif;
		endforeach;
		
		if (count($relations) > 0) $this->closeRelations();
		

	}

	protected function parseType($type){
        $types = array(
	        'tinyint'    => 'TINYINT',
	        'smallint'   => 'SMALLINT',
	        'mediumint'  => 'SMALLINT',
	        'int'        => 'INTEGER',
	        'integer'    => 'INTEGER',
	        'bigint'     => 'BIGINT',
	        'int24'      => 'BIGINT',
	        'real'       => 'DOUBLE',
	        'float'      => 'FLOAT',
	        'decimal'    => 'DECIMAL',
	        'numeric'    => 'NUMERIC',
	        'double'     => 'DOUBLE',
	        'char'       => 'CHAR',
	        'varchar'    => 'VARCHAR',
	        'date'       => 'DATE',
	        'time'       => 'TIME',
	        'year'       => 'INTEGER',
	        'datetime'   => 'TIMESTAMP',
	        'timestamp'  => 'TIMESTAMP',
	        'tinyblob'   => 'BINARY',
	        'blob'       => 'BLOB',
	        'mediumblob' => 'VARBINARY',
	        'longblob'   => 'LONGVARBINARY',
	        'longtext'   => 'CLOB',
	        'tinytext'   => 'VARCHAR',
	        'mediumtext' => 'LONGVARCHAR',
	        'text'       => 'LONGVARCHAR',
	        'enum'       => 'CHAR',
	        'set'        => 'CHAR',
        );
		
		return $types[$type];

	}


	protected function openTable($table){
		$aux = sprintf('<table name="%s" phpName="%s">', $table, $this->phpName($table));
		$this->xml .= $this->e2 . $aux . $this->line;
	}
	protected function closeTable(){
		$this->xml .= $this->e2 ."</table>". $this->line;
	}
	protected function openRelations(){
		$aux = '<relations>';
		$this->xml .= $this->e4 . $aux . $this->line;
	}	
	protected function closeRelations(){
		$this->xml .= $this->e4 ."</relations>". $this->line;
	}

	protected function openXml(){

		$this->xml .= '<?xml version="1.0" encoding="utf-8"?>' . $this->line;
		$this->xml .= sprintf('<database name="%s" namespace="Table\Model">', Config::get('plunder.database')) . $this->line;
	}

	protected function closeXml(){
		$this->xml .= '</database>';
		file_put_contents(BASE_DIR . "/app/config/schema_plunder.xml", $this->xml);
	}

	protected function phpName($name){
		$aux = explode("_", $name);
		$aux = array_map("ucfirst",$aux);
		return implode("", $aux);
	}

	protected function arrayToXml($name, $params, $close = true){
		$paramsAux = '';
		foreach ($params as $key => $value):
			$paramsAux .= $key ."=\"" . $value . "\" ";
		endforeach;
		return sprintf("<%s %s %s>", $name, trim($paramsAux), ($close) ? "/" : "");
	}

}