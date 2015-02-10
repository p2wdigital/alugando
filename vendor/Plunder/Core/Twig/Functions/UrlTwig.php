<?php 

namespace Plunder\Core\Twig\Functions;
use Plunder\Core\Container\Container;
use Twig_Extension;
use Twig_SimpleFunction;

class UrlTwig extends Twig_Extension
{
    public function getFunctions(){
        return array(
            new Twig_SimpleFunction('path', array($this,'generatePath'), array('is_safe'=>array('html'))),
            new Twig_SimpleFunction('url', array($this,'generateUrl'), array('is_safe'=>array('html'))),
            new Twig_SimpleFunction('link', array($this,'generateLink'), array('is_safe'=>array('html'))),
            new Twig_SimpleFunction('assert', array($this,'generateAssert'), array('is_safe'=>array('html'))),
        );
    }

    public function generatePath($name, $params = array()){
        $router = Container::get('router');
        return $router->generateUrl($name, $params);
    }

    public function generateUrl($name, $params = array()){
        $router = Container::get('router');
        return $router->generateUrl($name, $params, false);
    }

    public function generateLink($path){
        return sprintf('<link rel="stylesheet" type="text/css" href="%s">', $path);
    }

    public function generateAssert($path){
        $request = Container::get('request');
        return sprintf('%s/assert/%s', $request->getBaseFile(), ltrim($path, "/") );
    }


    public function getName(){
        return 'UrlTwig';
    }
}
