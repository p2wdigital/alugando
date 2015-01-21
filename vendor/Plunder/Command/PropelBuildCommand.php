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

/**
* 
*/
class PropelBuildCommand extends Command{
	

	protected function configure(){

		$this->setName("propel:model:build");
		$this->setDescription("");

		$this->addArgument("dbname", InputArgument::OPTIONAL, "Nome da base de dados");
	}


	protected function execute(InputInterface $input, OutputInterface $output){
		
		$this->getApplication()->add(new ModelBuildCommand);
		$command = $this->getApplication()->find('model:build');
		$arguments = array(
        	'command' => 'model:build',
        	'--schema-dir'=> "app/propel",
        	'--output-dir'=>"src",
        	'--config-dir'=>"app/config/config.yaml",
    	);
		$input = new ArrayInput($arguments);
    	$returnCode = $command->run($input, $output);

		$this->getApplication()->add(new ConfigConvertCommand);
		$command = $this->getApplication()->find('config:convert');
		$arguments = array(
        	'command' => 'config:convert',
        	'--output-dir'=>"app/config",
        	'--output-file'=>"config_propel.php",
        	'--config-dir'=>"app/config/config.yaml",
    	);
		$input = new ArrayInput($arguments);
    	$returnCode = $command->run($input, $output);



	}

}