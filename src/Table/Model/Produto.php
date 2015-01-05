<?php 
namespace Table\Model; 
class Produto { 
    /** 
    * The value for the id field.
    * @var        int
    */ 
    protected $id; 

    /** 
    * The value for the categoria field.
    * @var        
    */ 
    protected $categoria; 

    /** 
    * The value for the nome field.
    * @var        
    */ 
    protected $nome; 

    /** 
    * The value for the modelo field.
    * @var        
    */ 
    protected $modelo; 

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

    public function setId($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->id):
            $this->id = $val;
        endif;
    }

    public function setCategoria($val){ 
        if($val !== null)  $val = () $val; 

        if($val !== $this->categoria):
            $this->categoria = $val;
        endif;
    }

    public function setNome($val){ 
        if($val !== null)  $val = () $val; 

        if($val !== $this->nome):
            $this->nome = $val;
        endif;
    }

    public function setModelo($val){ 
        if($val !== null)  $val = () $val; 

        if($val !== $this->modelo):
            $this->modelo = $val;
        endif;
    }

}