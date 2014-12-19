<?php 

namespace Plunder\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\OutputInterface;
use Propel\Generator\Command\DatabaseReverseCommand;
/**
* 
*/
class ReverseCommand extends Command{
	

	protected function configure(){

		$this->setName("propel:reverse");
		$this->setDescription("");

		$this->addArgument("dbname", InputArgument::OPTIONAL, "Nome da base de dados");
	}


	protected function execute(InputInterface $input, OutputInterface $output){
		
		$this->getApplication()->add(new DatabaseReverseCommand);
		$command = $this->getApplication()->find('database:reverse');
		$arguments = array(
        	'command' => 'database:reverse',
        	'--output-dir'=>"app/propel",
        	'--config-dir'=>"app/config/config.yaml",
    	);

		$input = new ArrayInput($arguments);
    	$returnCode = $command->run($input, $output);

	}

}