<?php 
namespace Tabela\Model; 

use Plunder\ORM\ActiveRecord;


class OrcamentoItem extends ActiveRecord{ 

    protected $tableName    = 'orcamento_item';
    protected $className    = 'OrcamentoItem';
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
	* The value for the orcamento_id field.
	* @var        int
	*/ 
	protected $orcamento_id; 

	/** 
	* The value for the produto_id field.
	* @var        int
	*/ 
	protected $produto_id; 

	/** 
	* The value for the valor field.
	* @var        string
	*/ 
	protected $valor; 

	/** 
	* The value for the prazo field.
	* @var        int
	*/ 
	protected $prazo; 

	/** 
	* The value for the quantidade field.
	* @var        int
	*/ 
	protected $quantidade; 



    public function getId(){ 
        return $this->id;
    }

    public function getOrcamentoId(){ 
        return $this->orcamento_id;
    }

    public function getProdutoId(){ 
        return $this->produto_id;
    }

    public function getValor(){ 
        return $this->valor;
    }

    public function getPrazo(){ 
        return $this->prazo;
    }

    public function getQuantidade(){ 
        return $this->quantidade;
    }



    public function setId($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->id):
            $this->id = $val;
            $this->modColumns[] = 'id';
        endif;
    }

    public function setOrcamentoId($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->orcamento_id):
            $this->orcamento_id = $val;
            $this->modColumns[] = 'orcamento_id';
        endif;
    }

    public function setProdutoId($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->produto_id):
            $this->produto_id = $val;
            $this->modColumns[] = 'produto_id';
        endif;
    }

    public function setValor($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->valor):
            $this->valor = $val;
            $this->modColumns[] = 'valor';
        endif;
    }

    public function setPrazo($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->prazo):
            $this->prazo = $val;
            $this->modColumns[] = 'prazo';
        endif;
    }

    public function setQuantidade($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->quantidade):
            $this->quantidade = $val;
            $this->modColumns[] = 'quantidade';
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
		  'OrcamentoId' => 'orcamento_id',
		  'ProdutoId' => 'produto_id',
		  'Valor' => 'valor',
		  'Prazo' => 'prazo',
		  'Quantidade' => 'quantidade',
		);

    }
    protected function getAutoIncrement(){
        return array (
		  0 => 'id',
		);
    }
}