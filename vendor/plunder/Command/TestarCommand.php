<?php 

namespace Plunder\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


/**
* 
*/
class TestarCommand extends Command{
	

	protected function configure(){

		$this->setName("plunder:mundo");
		$this->setDescription("Testando o Mundo");

		$this->addArgument("nome", InputArgument::OPTIONAL, "Informe um nome para o teste?");
	}


	protected function execute(InputInterface $input, OutputInterface $output){

		$name = $input->getArgument("nome");

		$output->writeln("Ola mundo: " .$name . " Fim:" );

	}

}