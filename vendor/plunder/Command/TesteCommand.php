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
class TesteCommand extends Command{
	

	protected function configure(){

		$this->setName("plunder:ola");
		$this->setDescription("Testando o Ola");

		$this->addArgument("nome", InputArgument::OPTIONAL, "Informe um nome para o teste?");
	}


	protected function execute(InputInterface $input, OutputInterface $output){

		$name = $input->getArgument("nome");

		$output->writeln("Ola mundo: " .$name . " Fim:" );

	}

}