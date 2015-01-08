<?php 

namespace Plunder\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\OutputInterface;
use Propel\Generator\Command\ModelBuildCommand;
use Propel\Generator\Command\ConfigConvertCommand;
use Plunder\Helpers\Plunder;

/**
* 
*/
class BuildCommand extends Command{
	protected $model 			= array(
			"columns"		=> "/model/modelColumns.php",
			"get"			=> "/model/modelGet.php",
			"set"			=> "/model/modelSet.php",
			"getRelation"	=> "/model/modelGetRelation.php",
			"setRelation"	=> "/model/modelSetRelation.php",
	);
	/**
	 * [$option opções inseridas no console]
	 * @var array
	 */
	protected $option 			= array();
	
	/**
	 * [$namespace para gerar as class ]
	 * @var null
	 */
	protected $namespace 		= null;
	
	/**
	 * [$use Array com todos os use]
	 * @var array
	 */
	protected $use       		= array();	  
	
	/**
	 * [$varsColumns array com todos os campos da tabela
	 * formato protected $nome_campo;\n]
	 * @var array
	 */
	protected $varsColumns		= array();

	/**
	 * [$gets function get para os campos da tabela e relacoes]
	 * @var array
	 */
	protected $gets 			= array();	  

	/**
	 * [$sets function sets para os campos da tabela e ralações]
	 * @var array
	 */
	protected $sets 			= array();    

	/**
	 * [$colsMap array com mapa da tabela no formato NomeCampo => nome_campo]
	 * @var array
	 */
	protected $colsMap 			= array();

	/**
	 * [$autoIncrement array com as colunas de Auto Increment]
	 * @var array
	 */
	protected $autoIncrement 	= array();	  

	/**
	 * [$primary Array com todas as chaves primárias]
	 * @var array
	 */
	protected $primary 			= array();	  

	/**
	 * [$mapRelations Mapa da relações da tabela 
	 * formato: array(ReferenceTable => array(ReferenceColumn => ColumnTable))]
	 * @var array
	 */
	protected $mapRelations		= array();	  

	/**
	 * [$className Nome da class CamelCase do Nome da Tabela]
	 * @var null
	 */
	protected $className		= null;

	/**
	 * [$tableName Nome da tabela]
	 * @var null
	 */
	protected $tableName		= null;

	/**
	 * [$validation Validações basicas da tabela
	 * formato: TODO]
	 * @var array
	 */
	protected $validation 		= array();

	/**
	 * [$relations Array com as relações de todas as tabelas da base]
	 * @var array
	 */
	protected $relations 		= array();	  

	/**
	 * [configure Configuração do comando e opcoes]
	 * @return [type] [description]
	 */
	protected function configure(){
		$this->setName("plunder:model:build");
		$this->addOption('ns',null,InputOption::VALUE_REQUIRED,'The Namespace to generate php class');
		$this->addOption('dir',"app/ORM",InputOption::VALUE_REQUIRED,'The directory schema file');
		$this->addOption('file',"plunder_schema.xml",InputOption::VALUE_REQUIRED,'The name of the schema file');
		$this->setDescription("Generate php classes from schema.xml file");
	}

	/**
	 * [execute description]
	 * @param  InputInterface  $input  [Informações do input na linha de comando]
	 * @param  OutputInterface $output [Escreve na linha de comando]
	 * @return [type]                  [null]
	 */
	protected function execute(InputInterface $input, OutputInterface $output){
		$this->option['ns'] 		= $input->getOption('ns');
		$this->option['dir'] 		= ($input->getOption('dir')  == null) ? "app/config" : $input->getOption('dir');
		$this->option['file'] 		= ($input->getOption('file') == null) ? "schema_plunder.xml" : $input->getOption('file');

        $output->writeln(sprintf("ola : %s - %s - %s", $ns, $dir, $file));
	}


	/**
	 * [buildModel Baseado no schema.xml gera um class para cada tabela do schema]
	 * @return [type] [description]
	 */
	protected function buildModel(){
		$xmlStr = file_get_contents(BASE_DIR . SEP . $this->option['dir'] . SEP . $this->option['file']);
		$xml = new \SimpleXMLElement($xmlStr);
		
		//Armazena o namespace para utilização no decorrer do processo;
		$this->namespace = (string) $xml->attributes()['namespace'];
		//Gera a relação de todas as tabelas
		$this->generateRelations($xml);

		//Tabelas do schema; 
		foreach ($xml->table as $key => $value):

			$this->tableName = (string) $value->attributes()['name'];
			$this->className = (string) $value->attributes()['phpName'];
			//Colunas das tabelas
			foreach ($value->column as $col):
				$this->processColumn($col);
				//Gera as variaveis publicas dos campos da tabela;
				//$this->generateVar($col);
				//Gera as functions gets and sets
				//$this->generateFunc($col);			
			endforeach;

			$this->processRelation($this->className, $this->tableName);

			
			$this->createFile();
			
			$this->clear();
		endforeach;
	}

	/**
	 * [generateRelations Verifica a relação de todas as tabelas e
	 * gera um espelho da relação invertida para a tabela de referencia,
	 * guarda todas as informacoes na variável relations para utilizacao
	 * no decorrer do processo]
	 * @param  [SimplesXMLElement] $xml [xml do arquivo schema.xml]
	 */
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

				//Relação invertida da tabela, ou seja para um relação ManyToOne existe uma relação OneToMany
				//desta forma geramos uma relação invertida da tabela a fim de gerar os Gets e Sets de ambos 
				//os lados da relação, informamos no campo foreing = true a tabela dependente da relacao ou seja
				//a tabela que carrega em sua chave a chave primaria da outra; 
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
		$this->relations = $keys;
	}
	/**
	 * [processColumn Gera variaveis das colunas, funções gets e sets
	 * entre outras informações relevantes]
	 * @param  [type] $col [description]
	 * @return [type]      [description]
	 */
	private function processColumn($col){
		
		$column 	= (string) $col->attributes()['name'];
		$phpName	= (string) $col->attributes()['phpName'];
		$type 		= (string) $col->attributes()['type'];
		$primary  	= (boolean) $col->attributes()['primaryKey']|false;
		$auto   	= (boolean) $col->attributes()['autoIncrement']|false;
		$required  	= (boolean) $col->attributes()['required']|false;
		$size   	= (integer) $col->attributes()['size']|0;

		// Gera variavels protected;
		$dump 		 			= file_get_contents(__DIR__ . $this->model['column']);
		$replace['search'] 		= array("{field_type}", "{type}", "{varname}");
		$replace['replace'] 	= array("field", $this->fromToType($type), $column);
		$dump 					= str_replace($replace['search'], $replace['replace'], $dump);
		$this->varsColumns[] 	= $dump;
		
		// Gera function gets;
		$dump 		 			= file_get_contents(__DIR__ . $this->model['get']);
		$replace['search'] 		= array("{phpName}", "{type}", "{varname}");
		$replace['replace'] 	= array($phpName, $this->fromToType($type), $column);
		$dump 					= str_replace($replace['search'], $replace['replace'], $dump);
		$this->gets[] 			=  $dump;
		
		// Gera function sets;
		$dump 		 			= file_get_contents(__DIR__ . $this->model['set']);
		$dump 					= str_replace($replace['search'], $replace['replace'], $dump);
		$this->sets[] 			=  $dump;

		// Gera Mapa da Coluna na no formato CamelCase => camel_case
		$this->colsMap[$phpName] = $column;

		// Gera array com as chaves primarias
		if ($primary) 	$this->primary[] 				= $column;

		// Gera Array com as colunas autoIncrement
		if ($auto)		$this->autoIncrement[] 			= $column;

		// Gera array com regras das colunas Required
		if ($required)	$this->validation[$column]		= array("NoBlack");
		if ($size > 0 && $this->fromToType($type) == 'string'):
			$this->validation[$column]		= array("Length"=>array('max'=>$size));
		endif;

	}

	/**
	 * [processRelation Verifica o tipo de relação da tabela e gera 
	 * funcoes correspondentes]
	 * @param  [type] $tableCamel [description]
	 * @param  [type] $table      [description]
	 * @return [type]             [description]
	 */
	private function processRelation($tableCamel, $table){
		//Retorna apenas relações da tabela em preocessamento
		$relations = array_filter($this->relations, function($var) use ($table){
			return $var['table'] == $table;
		});

		foreach ($relations as $key => $value):
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
		$phpName			= Plunder::phpName($relation['referenceTable']);
		$foreing 			= $relation['foreing'];
		$column 			= $relation['column'];
		$referenceColumn	= $relation['referenceColumn'];

		// Gera function gets;
		$dump 		 			= file_get_contents(__DIR__ . $this->model['getRelation']);
		$replace['search'] 		= array("{phpName}");
		$replace['replace'] 	= array($phpName);
		$dump 					= str_replace($replace['search'], $replace['replace'], $dump);
		$this->gets[] 			=  $dump;

		// Gera function gets;
		$dump 		 			= file_get_contents(__DIR__ . $this->model['setRelation']);
		$replace['search'] 		= array("{phpName}","{set}","{mod}");
		$replace['replace'] 	= array($phpName, ($foreing) ? "add" : "set", ($foreing) ? "add" : "mod");
		$dump 					= str_replace($replace['search'], $replace['replace'], $dump);
		$this->sets[] 			=  $dump;

		$this->use[] = sprintf("use %s\\%s;\n", $this->namespace, $phpName);
		$this->mapRelations[$tableCamel] = array( $referenceColumn => $column);
		$this->varsColumns[] = sprintf("\tprotected \$a%s;\n\n", $phpName);
	}

	private function relOneToMany($relation){
		$phpName	 		= $this->phpName($relation['referenceTable']);
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

}