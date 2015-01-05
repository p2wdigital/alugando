<?php 
namespace Table\Model; 
class ProdutoValor { 
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
        endif;
    }

    public function setProdutoId($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->produto_id):
            $this->produto_id = $val;
        endif;
    }

    public function setPrazo($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->prazo):
            $this->prazo = $val;
        endif;
    }

    public function setValor($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->valor):
            $this->valor = $val;
        endif;
    }

}