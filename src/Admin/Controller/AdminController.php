<?php

namespace Admin\Controller;

use Plunder\Core\Controller\Controller;
use Plunder\Core\HttpRequest\Request;
//use Table\Model\ClienteQuery;
use Tabela\Model\Cliente;
use Tabela\Model\User;
use Plunder\Core\Container\Container;
/**
* @Route("/") 
*/
class AdminController extends Controller
{
	private $namespace 		= null;       //OK
	private $use       		= array();	  //NOK
	private $varsColumns	= array();	  //OK
	private $gets 			= array();	  //TODO
	private $sets 			= array();    //TODO
	private $colsMap 		= array();	  //OK
	private $autoIncrement 	= array();	  //NOK
	private $primary 		= array();	  //NOK

	private $relations 		= array();	  //OK
	private $mapRelations	= array();	  //OK

	private $className		= null;
	private $tableName		= null;
	private $validation 	= array();



	/**
	 * @Route("/", name="admin_home")
	 */
	public function indexAction(){
		 
		//$cliente = ClienteQuery::create()->select(array('RazaoSocial', 'Contato'))->find();
		//$cliente = array();
		
		$db = new \PDO('mysql:host=localhost;dbname=information_schema', "root", null);
		$db-> exec("SET CHARACTER SET utf8");
//		$result = $db->query("select * from produto");
//		$cliente = $result->fetchAll();
		//$query = sprintf("Select * from columns where table_schema = '%s'", 'wep2');
		
		//$query = 'select * from TABLE_CONSTRAINTS';
		//$result = $db->query($query);
		//var_dump(get_class_methods($db));
		//var_dump($db->errorInfo());

		//var_dump($result->fetchAll());
		$cliente = array();
		//var_dump($cliente);
		return $this->render("Admin:Admin:index.html.twig", array("cliente"=>$cliente));
		//echo "Hello Word";
	}

	/**
	 * @Route("/update/{id}/{user}", name="admin_new", requirements={"id":"\d+"} defaults={"user":"palex"})
	 */
	public function updateAction($user, $id ){
		$cliente = new Cliente();
		$cliente->setRazaoSocial("Wep2 Locações");
		$cliente->setContato("Paulo Alexandre");
		
		$usuario = new User();
		$usuario->setPassword('143486');
		$usuario->setSalt('Set Cliente');
		//$usuario->getCliente();
		$usuario->addCliente($cliente);

		$usuario->save();
		echo $usuario->getCliente()->getId();
		//echo $cliente->getId() . $user;
	}

	/**
	 * @Route("/new/{page}", name="admin_new", defaults={"page":1}, requirements={"page":"\d*"})
	 */
	public function newAction($page){
		$xmlStr = file_get_contents(BASE_DIR . "/app/config/schema_plunder.xml");
		$xml = new \SimpleXMLElement($xmlStr);
		
		$this->namespace = (string) $xml->attributes()['namespace'];
		$this->generateRelations($xml);

		$table = '';
		foreach ($xml->table as $key => $value):

			$this->tableName = (string) $value->attributes()['name'];
			$this->className = (string) $value->attributes()['phpName'];

			foreach ($value->column as $col):

				//Gera as variaveis publicas dos campos da tabela;
				$this->generateVar($col);
				
				//Gera as functions gets and sets
				$this->generateFunc($col);
				
			endforeach;
			$this->relationsFunc($this->className, $this->tableName);

			//mkdir(BASE_DIR."/src/Tabela/Model");
			$this->createFile();
			
			$this->clear();
		endforeach;
	}

	private function createFile(){
		/* var_dump($this->namespace);
		 var_dump($this->className);
		 var_dump($this->tableName);
		 var_dump($this->use);
		 var_dump($this->varsColumns);
		 var_dump($this->gets);
		 var_dump($this->sets);
		 var_dump($this->colsMap);
		 var_dump($this->primary);
		 var_dump($this->autoIncrement);
		 var_dump($this->validation);
		 var_dump($this->mapRelations);
		*/
		$model = file_get_contents(__DIR__ ."/modelReverse.php");

		$model = str_replace("{namespace}", $this->namespace, $model);
		$model = str_replace("{use}", implode("", array_unique($this->use)), $model);
		$model = str_replace("{className}", $this->className, $model);
		$model = str_replace("{tableName}", $this->tableName, $model);
		$model = str_replace("{varsColumns}", implode("",$this->varsColumns), $model);
		$model = str_replace("{gets}", implode("", $this->gets), $model);
		$model = str_replace("{sets}", implode("", $this->sets), $model);
		
		$colsMap = str_replace("\n", "\n\t\t", var_export($this->colsMap, true));
		$model = str_replace("{colsMap}", $colsMap , $model);

		$mapRelations = str_replace("\n", "\n\t\t", var_export($this->mapRelations, true));
		$model = str_replace("{mapRelations}", $mapRelations, $model);

		$autoIncrement = str_replace("\n", "\n\t\t", var_export($this->autoIncrement, true));
		$model = str_replace("{autoIncrement}", $autoIncrement, $model);


		$file = sprintf("%s/src/%s/%s.php", BASE_DIR, str_replace("\\", "/", $this->namespace),$this->className);
		file_put_contents($file, $model);


	}



	private function clear(){
		 $this->use       		= array();	  	//todo - relations
		 $this->varsColumns		= array();	  	//todo - relations
		 $this->gets 			= array();	  	//todo - relations
		 $this->sets 			= array();    	//todo - relations
		 $this->colsMap 		= array();	  	//ok
		 $this->autoIncrement 	= array();	  	//ok
		 $this->primary 		= array();	  	//ok
		 $this->className		= null; 		//ok
		 $this->validation 		= array();	  	//ok
		 $this->mapRelations	= array();	  	//ok
	}



	private function generateRelations($xml){
		$keys = array();
		foreach ($xml->table as $key => $value):
		foreach ($value->relations as $key => $relations):
			foreach ($relations->{'foreing-key'} as $key => $foreing):
				$keys[] = array(
					'type'				=> (string) $foreing->attributes()['type'],
					'table'				=> (string) $value->attributes()['name'],
					'column'			=> (string) $foreing->attributes()['column'],
					'referenceTable'	=> (string) $foreing->attributes()['referenceTable'],
					'referenceColumn'	=> (string) $foreing->attributes()['referenceColumn'],
					'foreing'			=> true,
				);

				$keys[] = array(
					'type'				=> $this->invertedRelations((string) $foreing->attributes()['type']),
					'table'				=> (string) $foreing->attributes()['referenceTable'],
					'column'			=> (string) $foreing->attributes()['referenceColumn'],
					'referenceTable'	=> (string) $value->attributes()['name'],
					'referenceColumn'	=> (string) $foreing->attributes()['column'],
					'foreing'			=> false,
				);
			endforeach;
		endforeach;
		endforeach;
		//var_dump($keys);
		$this->relations = $keys;
	}

	private function generateVar($col){
		//var_dump($col->attributes());
		$column 	= (string) $col->attributes()['name'];
		$phpName	= (string) $col->attributes()['phpName'];
		$type 		= (string) $col->attributes()['type'];
		$primary  	= (boolean) $col->attributes()['primaryKey']|false;
		$auto   	= (boolean) $col->attributes()['autoIncrement']|false;
		$required  	= (boolean) $col->attributes()['required']|false;
		$size   	= (integer) $col->attributes()['size']|0;

		$dump  = "\t/** \n";
		$dump .= "\t* The value for the ". $column ." field.\n";
		$dump .= "\t* @var        ". $this->fromToType($type) ."\n";
		$dump .= "\t*/ \n";
		$dump .= "\tprotected $" . $column ."; \n\n";
		
		$this->varsColumns[] = $dump;
		$this->colsMap[$phpName] = $column;

		if ($primary) 	$this->primary[] 				= $column;
		if ($auto)		$this->autoIncrement[] 			= $column;
		if ($required)	$this->validation[$column]		= array("NoBlack");
		
		if ($size > 0 && $this->fromToType($type) == 'string'):
			$this->validation[$column]		= array("Length"=>array('max'=>$size));
		endif;



	}

	private function generateFunc($col){
		$column 	= (string) $col->attributes()['name'];
		$phpName	= (string) $col->attributes()['phpName'];
		$type 		= (string) $col->attributes()['type'];

		$func  = sprintf("\tpublic function get%s(){ \n", $phpName);
		$func .= sprintf("\t\treturn \$this->%s;\n\t}\n\n", $column);
		$this->gets[] = str_replace("\t", "    ",$func);

		$func  = sprintf("\tpublic function set%s(\$val){ \n", $phpName);
		$func .= sprintf("\t\tif(\$val !== null)  \$val = (%s) \$val; \n\n",$this->fromToType($type));
		$func .= sprintf("\t\tif(\$val !== \$this->%s):\n", $column);
		$func .= sprintf("\t\t\t\$this->%s = \$val;\n", $column);
		$func .= sprintf("\t\t\t\$this->modColumns[] = '%s';\n", $column);
		$func .= sprintf("\t\tendif;\n\t}\n\n", $column);

		$this->sets[] = str_replace("\t", "    ",$func);
	}

	private function relationsFunc($tableCamel, $table){
		$relations = array_filter($this->relations, function($var) use ($table){
			return $var['table'] == $table;
		});

		foreach ($relations as $key => $value):
			var_dump($value);
			$tableCamel = $this->phpName($value['table']);
			if ($value['type'] == 'OneToOne'):
				$this->relOneToOne($value);
			endif;
			if ($value['type'] == 'OneToMany'):
				$this->relOneToMany($value);

			endif;

		endforeach;

		//$func = sprintf("\tpublic function get%s(){\n")
	}

	private function relOneToOne($relation){
		$tableCamel 		= $this->phpName($relation['referenceTable']);
		$foreing 			= $relation['foreing'];
		$column 			= $relation['column'];
		$referenceColumn	= $relation['referenceColumn'];

		$dump  = sprintf("\tpublic function get%s(){\n", $tableCamel);
		$dump .= sprintf("\t\treturn \$this->a%s;\n\t}\n\n", $tableCamel);
		$this->gets[] = $dump;

		$dump  = sprintf("\tpublic function %s%s(%s \$val){\n",($foreing) ? "add" : "set", $tableCamel, $tableCamel);
		$dump .= sprintf("\t\t\$this->a%s = \$val;\n", $tableCamel);
		$dump .= sprintf("\t\t\$this->%sRelations[] = '%s';\n\t}\n\n",($foreing) ? "add" : "mod", $tableCamel);
		$this->sets[] = $dump;

		$this->use[] = sprintf("use %s\\%s;\n", $this->namespace, $tableCamel);
		$this->mapRelations[$tableCamel] = array( $referenceColumn => $column);
		$this->varsColumns[] = sprintf("\tprotected \$a%s;\n\n", $tableCamel);
	}

	private function relOneToMany($relation){
		$tableCamel 		= $this->phpName($relation['referenceTable']);
		$pluralize			= $this->pluralize($tableCamel);
		$foreing 			= $relation['foreing'];
		$column 			= $relation['column'];
		$referenceColumn	= $relation['referenceColumn'];

		$dump  = sprintf("\tpublic function get%s(){\n", $pluralize);
		$dump .= sprintf("\t\treturn \$this->a%s;\n\t}\n\n", $pluralize);
		$this->gets[] = $dump;

		$dump  = sprintf("\tpublic function set%s(%s \$val){\n",$tableCamel, $tableCamel);
		$dump .= sprintf("\t\t\$this->a%s = \$val;\n", $tableCamel);
		$dump .= sprintf("\t\t\$this->modRelations[] = '%s';\n\t}\n\n", $tableCamel);
		$this->sets[] = $dump;

		$this->use[] = sprintf("use %s\\%s;\n", $this->namespace, $tableCamel);
		$this->mapRelations[$tableCamel] = array( $referenceColumn => $column);
		$this->varsColumns[] = sprintf("\tprotected \$a%s;\n\n", $tableCamel);
	}

	private function pluralize($name){
		if(preg_match("/m$/i", $name)):
			return preg_replace("/m$/", "ns", $name);
		endif;
		return $name . "s";
	}

	protected function phpName($name){
		$aux = explode("_", $name);
		$aux = array_map("ucfirst",$aux);
		return implode("", $aux);
	}

	private function fromToType($type){

		$types = array(
			'CHAR'          => 'string',
		    'VARCHAR'       => 'string',
		    'LONGVARCHAR'   => 'string',
		    'CLOB'          => 'string',
		    'CLOB_EMU'      => 'resource',
		    'NUMERIC'       => 'string',
		    'DECIMAL'       => 'string',
		    'TINYINT'       => 'int',
		    'SMALLINT'      => 'int',
		    'INTEGER'       => 'int',
		    'BIGINT'        => 'string',
		    'REAL'          => 'double',
		    'FLOAT'         => 'double',
		    'DOUBLE'        => 'double',
		    'BINARY'        => 'string',
		    'VARBINARY'     => 'string',
		    'LONGVARBINARY' => 'string',
		    'BLOB'          => 'resource',
		    'BU_DATE'       => 'string',
		    'DATE'          => 'string',
		    'TIME'          => 'string',
		    'TIMESTAMP'     => 'string',
		    'BU_TIMESTAMP'  => 'string',
		    'BOOLEAN'       => 'boolean',
		    'BOOLEAN_EMU'   => 'boolean',
		    'OBJECT'        => '',
		    'PHP_ARRAY'     => 'array',
		    'ENUM'          => 'int',
		);
		return $types[(string)$type];
	}
	private function invertedRelations($relation){
		$relations = array(
			'ManyToOne' => 'OneToMany',
			'OneToMany' => 'ManyToOne',
			'OneToOne'	=> 'OneToOne',
		);

		return $relations[$relation];
	}

}