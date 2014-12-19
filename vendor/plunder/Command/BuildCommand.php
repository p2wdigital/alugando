<?php 

namespace Plunder\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\OutputInterface;
use Propel\Generator\Command\ModelBuildCommand;
/**
* 
*/
class BuildCommand extends Command{
	

	protected function configure(){

		$this->setName("propel:build");
		$this->setDescription("");

	}


	protected function execute(InputInterface $input, OutputInterface $output){
		
		$this->getApplication()->add(new ModelBuildCommand);
		$command = $this->getApplication()->find('model:build');
		$arguments = array(
        	'command' => 'model:build',
        	'--config-dir'=>"app/config/config.yaml",
        	'--schema-dir'=>"app/propel",
        	'--output-dir'=> "src/"
    	);

		$input = new ArrayInput($arguments);
    	$returnCode = $command->run($input, $output);

	}

}