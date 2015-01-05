<?php 
namespace Tabela\Model; 

use Plunder\ORM\ActiveRecord;


class ProdutoValor extends ActiveRecord{ 

    protected $tableName    = 'produto_valor';
    protected $className    = 'ProdutoValor';
    protected $modColumns   = array();
    protected $modRelations = array();
    protected $addRelations = array();
    protected $new          = null;
    protected $updated      = null;
    protected $deleted      = null;
    

	/** 
	* The value for the id field.
	* @var        int
	*/ 
	protected $id; 

	/** 
	* The value for the produto_id field.
	* @var        int
	*/ 
	protected $produto_id; 

	/** 
	* The value for the prazo field.
	* @var        int
	*/ 
	protected $prazo; 

	/** 
	* The value for the valor field.
	* @var        string
	*/ 
	protected $valor; 



    public function getId(){ 
        return $this->id;
    }

    public function getProdutoId(){ 
        return $this->produto_id;
    }

    public function getPrazo(){ 
        return $this->prazo;
    }

    public function getValor(){ 
        return $this->valor;
    }



    public function setId($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->id):
            $this->id = $val;
            $this->modColumns[] = 'id';
        endif;
    }

    public function setProdutoId($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->produto_id):
            $this->produto_id = $val;
            $this->modColumns[] = 'produto_id';
        endif;
    }

    public function setPrazo($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->prazo):
            $this->prazo = $val;
            $this->modColumns[] = 'prazo';
        endif;
    }

    public function setValor($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->valor):
            $this->valor = $val;
            $this->modColumns[] = 'valor';
        endif;
    }



    protected function getMapRelations($table){
        $relations = array (
		);

        return $relations[$table];
    }

    protected function getColumnsMap(){
        return array (
		  'Id' => 'id',
		  'ProdutoId' => 'produto_id',
		  'Prazo' => 'prazo',
		  'Valor' => 'valor',
		);

    }
    protected function getAutoIncrement(){
        return array (
		  0 => 'id',
		);
    }
}