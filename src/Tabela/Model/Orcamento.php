<?php 
namespace Tabela\Model; 

use Plunder\ORM\ActiveRecord;
use Tabela\Model\OrcamentoItem;


class Orcamento extends ActiveRecord{ 

    protected $tableName    = 'orcamento';
    protected $className    = 'Orcamento';
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
	* The value for the cliente_id field.
	* @var        int
	*/ 
	protected $cliente_id; 

	/** 
	* The value for the valor_total field.
	* @var        string
	*/ 
	protected $valor_total; 

	/** 
	* The value for the prazo field.
	* @var        int
	*/ 
	protected $prazo; 

	/** 
	* The value for the descricao field.
	* @var        string
	*/ 
	protected $descricao; 

	protected $aOrcamentoItem;



    public function getId(){ 
        return $this->id;
    }

    public function getClienteId(){ 
        return $this->cliente_id;
    }

    public function getValorTotal(){ 
        return $this->valor_total;
    }

    public function getPrazo(){ 
        return $this->prazo;
    }

    public function getDescricao(){ 
        return $this->descricao;
    }

	public function getOrcamentoItens(){
		return $this->aOrcamentoItens;
	}



    public function setId($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->id):
            $this->id = $val;
            $this->modColumns[] = 'id';
        endif;
    }

    public function setClienteId($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->cliente_id):
            $this->cliente_id = $val;
            $this->modColumns[] = 'cliente_id';
        endif;
    }

    public function setValorTotal($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->valor_total):
            $this->valor_total = $val;
            $this->modColumns[] = 'valor_total';
        endif;
    }

    public function setPrazo($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->prazo):
            $this->prazo = $val;
            $this->modColumns[] = 'prazo';
        endif;
    }

    public function setDescricao($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->descricao):
            $this->descricao = $val;
            $this->modColumns[] = 'descricao';
        endif;
    }

	public function setOrcamentoItem(OrcamentoItem $val){
		$this->aOrcamentoItem = $val;
		$this->modRelations[] = 'OrcamentoItem';
	}



    protected function getMapRelations($table){
        $relations = array (
		  'OrcamentoItem' => 
		  array (
		    'orcamento_id' => 'id',
		  ),
		);

        return $relations[$table];
    }

    protected function getColumnsMap(){
        return array (
		  'Id' => 'id',
		  'ClienteId' => 'cliente_id',
		  'ValorTotal' => 'valor_total',
		  'Prazo' => 'prazo',
		  'Descricao' => 'descricao',
		);

    }
    protected function getAutoIncrement(){
        return array (
		  0 => 'id',
		);
    }
}