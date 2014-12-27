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
		$this->setDescription("Reverse data base to XML");
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
				if($table != "") $this->closeTable();
				$this->openTable($value['TABLE_NAME']);
				$table = $value['TABLE_NAME'];
			endif;
			$this->column($value);

		endforeach;
		$this->closeTable();
		$this->closeXml();
	}


	protected function column($col){
		$column = array();
		$column['name'] 		= $col['COLUMN_NAME'];
		$column['phpName'] 		= $this->phpName($col['COLUMN_NAME']);
		$column['type']			= $this->parseType($col['DATA_TYPE']);

		if ($col['COLUMN_KEY'] == "PRI") 
			$column['primaryKey'] = "true";
		
		if ($col['COLUMN_KEY'] == "UNI") 
			$column['uniqueKey'] = "true";
		
		if (strpos($col['EXTRA'], "auto_increment") !== false) 
			$column['autoIncrement'] = "true";
		
		if ($col['IS_NULLABLE'] == "YES") 
			$column['required'] = "true";


		if ($col['CHARACTER_MAXIMUM_LENGTH'] !== null && $col['DATA_TYPE'] == 'decimal')
			$column['size'] = $col['CHARACTER_MAXIMUM_LENGTH'];

		if($col['DATA_TYPE'] == 'decimal' && $col['NUMERIC_PRECISION'] !== null):
			$column['size'] = $col['NUMERIC_PRECISION'];
			$column['scale'] = $col['NUMERIC_SCALE'];
		endif;


		$val = $this->arrayToXml("column", $column);
		$this->xml .= $this->e4 . $val . $this->line;
	}

	protected function parseType($type){
		switch (strtolower($type)):
			case 'int':
			case 'integer':
				return "INTEGER";
				break;
			case 'varchar':
				return "VARCHAR";
				break;
			case 'decimal':
				return "DECIMAL";
				break;
			case 'text':
				return "TEXT";
				break;
			case 'date':
				return "DATE";
				break;
			case 'timestamp':
				return "TIMESTAMP";
				break;
		endswitch;

	}


	protected function openTable($table){
		$aux = sprintf('<table name="%s" phpName="%s">', $table, $this->phpName($table));
		$this->xml .= $this->e2 . $aux . $this->line;
	}
	protected function closeTable(){
		$this->xml .= $this->e2 ."</table>". $this->line;
	}

	protected function openXml(){

		$this->xml .= '<?xml version="1.0" encoding="utf-8"?>' . $this->line;
		$this->xml .= sprintf('<database name="%s" namespace="Table\Model">', Config::get('plunder.database')) . $this->line;
	}

	protected function closeXml(){
		$this->xml .= '</database>';
		file_put_contents(BASE_DIR . "/app/propel/schema_plunder.xml", $this->xml);
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