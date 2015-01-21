<?php 


namespace Plunder\Core\Twig;
use Twig_Environment;
/**
* Class TwigEnvironment
* Extends original TwigEnvironment para altera a forma de renderizar que os methodos
* render e display tratam os arquivos, para que não seja necessário informar a pasta View 
* nestes methodos, e alterar o comportamento de / para :
*/
class TwigEnvironment extends Twig_Environment
{
	
    public function render($name, array $context = array()){
		return parent::render($this->changeNameTemplating($name, $context));
    }

    public function display($name, array $context = array()){
		parent::display($this->changeNameTemplating($name, $context));
    }

	private function changeNameTemplating($name){
		$aux 	 = array_filter(explode(":", $name));

		$caminho = '';
		if (isset($aux[0])):
			$caminho 	 = sprintf("%s/View/", $aux[0]);
			unset($aux[0]);
		endif;
		
		$caminho 	.= implode("/", $aux);
		return $caminho;
	}

}