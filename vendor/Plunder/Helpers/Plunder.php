<?php

namespace Plunder\Helpers;
/**
* Plunder Helps Static
*/
class Plunder{

	/**
	 * [mkDir Verifica se o diretorio existe caso contrario cria o diretorio em cascata]
	 * @param  [type] $file [description]
	 * @return [type]       [description]
	 */
	public static function mkDir($file){
		preg_match("/(\S+)(\/+\w+\.+\w+)|(\S+[^\/\.])/", $file, $mat);
		$file = ($mat[1] != '') ? $mat[1] : $mat[3];

		$aux = explode("/", $file);
		$path = '';
		foreach ($aux as $key => $value):
			$path .= $value ."/";
			if(!is_dir($path)):
				mkdir($path);
			endif;
		endforeach;
	}

	/**
	 * [pluralize description]
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	public static function pluralize($name){
		if(preg_match("/m$/i", $name)):
			return preg_replace("/m$/", "ns", $name);
		endif;
		return $name . "s";
	}

	/**
	 * [phpName description]
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	public static function phpName($name){
		$aux = explode("_", $name);
		$aux = array_map("ucfirst",$aux);
		return implode("", $aux);
	}
}