<?php 
namespace {namespace}; 

use Plunder\ORM\ActiveRecord;
{use}

class {className} extends ActiveRecord{ 

    protected $tableName    = '{tableName}';
    protected $className    = '{className}';
    protected $modColumns   = array();
    protected $modRelations = array();
    protected $addRelations = array();
    protected $new          = null;
    protected $updated      = null;
    protected $deleted      = null;
    

{varsColumns}

{gets}

{sets}

    protected function getMapRelations($table){
        $relations = {mapRelations};

        return $relations[$table];
    }

    protected function getColumnsMap(){
        return {colsMap};

    }
    protected function getAutoIncrement(){
        return {autoIncrement};
    }
}