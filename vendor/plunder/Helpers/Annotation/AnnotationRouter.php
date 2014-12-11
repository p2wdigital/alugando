<?php 

namespace Plunder\Helpers\Annotation;

/**
* Class Annotation Router
*/
class AnnotationRouter extends Annotation
{
	public function __construct(Finder $finder, Cache $cache){
		$this->finder 	= $finder;
		$this->cache 	= $cache;
	}
}