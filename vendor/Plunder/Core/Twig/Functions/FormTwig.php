<?php 

namespace Plunder\Core\Twig\Functions;
use Twig_Extension;
use Twig_SimpleFunction;
use Plunder\Core\Twig\TwigLoaderFilesystem;

class FormTwig extends Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('form_row', array($this,'form_row'), array('is_safe'=>array('html'))),
        );
    }

    public function form_row($field, $option = array()){
		$cacheDir 	= sprintf("app/cache/%s/twig", ENVIRONMENT);
		$debug 		= false;

		if (ENVIRONMENT == "dev") $debug = true;

		$loaderFile 	= new TwigLoaderFilesystem(array('src', 'app/View'));
		$loaderArray 	= new \Twig_Loader_Array(array(
				"formLoader.html"=>"{% use '::fields.html.twig' %} {% block form_row %} {{parent()}}{% endblock %}"
		));
		
		$loader 		= new \Twig_Loader_Chain(array($loaderArray, $loaderFile));
		$twig 			= new \Twig_Environment($loader, array('cache' => $cacheDir,'debug'=>$debug));

		$twig->addExtension(new \Twig_Extension_Debug());

		return $twig->render("formLoader.html", $option + $field);

    	
    }
    public function getName(){
        return 'FormTwig';
    }
}
