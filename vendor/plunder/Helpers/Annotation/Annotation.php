<?php 

namespace Plunder\Helpers\Annotation;

use Plunder\Helpers\Cache\Cache;
use Symfony\Component\Finder\Finder;
/**
* Class Annotation
*/
abstract class Annotation
{
	
	protected function verifyCache($path, Finder $finder, Cache $cache){
		$files = array();
		foreach ($finder as $key => $value):
			$files[] = $value->getPathname();
		endforeach;

		return $cache->verifyChanges($path, $files);
	}

}