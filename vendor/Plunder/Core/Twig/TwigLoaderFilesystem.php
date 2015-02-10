<?php 


namespace Plunder\Core\Twig;
use Twig_Loader_Filesystem;

/**
* Class TwigEnvironment
* Extends original TwigEnvironment para altera a forma de renderizar que os methodos
* render e display tratam os arquivos, para que não seja necessário informar a pasta View 
* nestes methodos, e alterar o comportamento de / para :
*/
class TwigLoaderFilesystem extends Twig_Loader_Filesystem
{


	protected function findTemplate($name){
		return parent::findTemplate($this->changeNameTemplating($name));
	}

	protected function changeNameTemplating($name){
		$aux 	 = array_filter(explode(":", $name));
		$caminho = '';
		if (isset($aux[0]) && strpos($name, ":") !==false):
			$caminho 	 = sprintf("%s/View/", $aux[0]);
			unset($aux[0]);
		endif;
			
		$caminho 	.= implode("/", $aux);
		//var_dump($aux, $caminho);

		return $caminho;
	}

}