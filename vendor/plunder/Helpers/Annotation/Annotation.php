<?php 

namespace Plunder\Helpers\Annotation;

use Plunder\Helpers\Cache\Cache;
use Symfony\Component\Finder\Finder;
/**
* Class Annotation
*/
abstract class Annotation
{
	protected $finder;
	protected $files;
	protected $cache;
	
	protected function verifyCache($path, Finder $finder){
		$files = array();
		foreach ($this->finder as $key => $value):
			$files[] = $value->getPathname();
		endforeach;

		return $this->cache->verifyChanges($path, $files);
	}

}