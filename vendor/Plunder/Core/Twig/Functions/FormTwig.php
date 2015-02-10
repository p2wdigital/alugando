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
            new Twig_SimpleFunction('form_widget', array($this,'form_widget'), array('is_safe'=>array('html'))),
            new Twig_SimpleFunction('form_error', array($this,'form_error'), array('is_safe'=>array('html'))),
        );
    }
    public function form_row($field, $option = array()){
    	return $this->form($field, "form_row", $option);
    }
    public function form_widget($field, $option = array()){
        return $this->form($field, "form_widget", $option);
    }
    public function form_error($field, $option = array()){
        return $this->form($field, "form_error", $option);
    }

    public function form($field, $type, $option = array()){
		$cacheDir 	= sprintf("app/cache/%s/twig", ENVIRONMENT);
		$debug 		= false;

		if (ENVIRONMENT == "dev") $debug = true;

		$loaderFile 	= new TwigLoaderFilesystem(array('src', 'app/View'));
		$loaderArray 	= new \Twig_Loader_Array(array(
				"formLoader.html"=>"{%- use '::fields.html.twig' -%} {%- block $type -%} {{-parent()-}}{%- endblock -%}"
		));
		
		$loader 		= new \Twig_Loader_Chain(array($loaderArray, $loaderFile));
		$twig 			= new \Twig_Environment($loader, array('cache' => $cacheDir,'debug'=>$debug));

		$twig->addExtension(new \Twig_Extension_Debug());

		if(key_exists('attr', $option) && key_exists('attr', $field)):
			$option['attr'] = $option['attr'] + $field['attr'];
		endif;

		return $twig->render("formLoader.html", $option + $field);

    	
    }
    public function getName(){
        return 'FormTwig';
    }
}
