<?php 
namespace Tabela\Model; 

use Plunder\ORM\ActiveRecord;
use Tabela\Model\OrcamentoItem;
use Tabela\Model\ProdutoValor;


class Produto extends ActiveRecord{ 

    protected $tableName    = 'produto';
    protected $className    = 'Produto';
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
	* The value for the categoria field.
	* @var        string
	*/ 
	protected $categoria; 

	/** 
	* The value for the nome field.
	* @var        string
	*/ 
	protected $nome; 

	/** 
	* The value for the modelo field.
	* @var        string
	*/ 
	protected $modelo; 

	protected $aOrcamentoItem;

	protected $aProdutoValor;



    public function getId(){ 
        return $this->id;
    }

    public function getCategoria(){ 
        return $this->categoria;
    }

    public function getNome(){ 
        return $this->nome;
    }

    public function getModelo(){ 
        return $this->modelo;
    }

	public function getOrcamentoItens(){
		return $this->aOrcamentoItens;
	}

	public function getProdutoValors(){
		return $this->aProdutoValors;
	}



    public function setId($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->id):
            $this->id = $val;
            $this->modColumns[] = 'id';
        endif;
    }

    public function setCategoria($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->categoria):
            $this->categoria = $val;
            $this->modColumns[] = 'categoria';
        endif;
    }

    public function setNome($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->nome):
            $this->nome = $val;
            $this->modColumns[] = 'nome';
        endif;
    }

    public function setModelo($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->modelo):
            $this->modelo = $val;
            $this->modColumns[] = 'modelo';
        endif;
    }

	public function setOrcamentoItem(OrcamentoItem $val){
		$this->aOrcamentoItem = $val;
		$this->modRelations[] = 'OrcamentoItem';
	}

	public function setProdutoValor(ProdutoValor $val){
		$this->aProdutoValor = $val;
		$this->modRelations[] = 'ProdutoValor';
	}



    protected function getMapRelations($table){
        $relations = array (
		  'OrcamentoItem' => 
		  array (
		    'produto_id' => 'id',
		  ),
		  'ProdutoValor' => 
		  array (
		    'produto_id' => 'id',
		  ),
		);

        return $relations[$table];
    }

    protected function getColumnsMap(){
        return array (
		  'Id' => 'id',
		  'Categoria' => 'categoria',
		  'Nome' => 'nome',
		  'Modelo' => 'modelo',
		);

    }
    protected function getAutoIncrement(){
        return array (
		  0 => 'id',
		);
    }
}