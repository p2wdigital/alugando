<?php

namespace Table\Model;

use Table\Model\Base\Menu as BaseMenu;

/**
 * Skeleton subclass for representing a row from the 'menu' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Menu extends BaseMenu{

public function getData($key){
	$var = (array) json_decode($this->dados);
	return (array_key_exists($key, $var)) ? $var[$key] : null;
}


}
