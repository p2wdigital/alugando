<?php 
namespace Table\Model; 
class Cliente { 
    /** 
    * The value for the id field.
    * @var        int
    */ 
    protected $id; 

    /** 
    * The value for the razao_social field.
    * @var        
    */ 
    protected $razao_social; 

    /** 
    * The value for the contato field.
    * @var        
    */ 
    protected $contato; 

    /** 
    * The value for the cep field.
    * @var        
    */ 
    protected $cep; 

    /** 
    * The value for the descricao field.
    * @var        string
    */ 
    protected $descricao; 

    /** 
    * The value for the dh_inclusao field.
    * @var        string
    */ 
    protected $dh_inclusao; 

    /** 
    * The value for the dh_alteracao field.
    * @var        string
    */ 
    protected $dh_alteracao; 

    public function getId(){ 
        return $this->id;
    }

    public function getRazaoSocial(){ 
        return $this->razao_social;
    }

    public function getContato(){ 
        return $this->contato;
    }

    public function getCep(){ 
        return $this->cep;
    }

    public function getDescricao(){ 
        return $this->descricao;
    }

    public function getDhInclusao(){ 
        return $this->dh_inclusao;
    }

    public function getDhAlteracao(){ 
        return $this->dh_alteracao;
    }

    public function setId($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->id):
            $this->id = $val;
        endif;
    }

    public function setRazaoSocial($val){ 
        if($val !== null)  $val = () $val; 

        if($val !== $this->razao_social):
            $this->razao_social = $val;
        endif;
    }

    public function setContato($val){ 
        if($val !== null)  $val = () $val; 

        if($val !== $this->contato):
            $this->contato = $val;
        endif;
    }

    public function setCep($val){ 
        if($val !== null)  $val = () $val; 

        if($val !== $this->cep):
            $this->cep = $val;
        endif;
    }

    public function setDescricao($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->descricao):
            $this->descricao = $val;
        endif;
    }

    public function setDhInclusao($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->dh_inclusao):
            $this->dh_inclusao = $val;
        endif;
    }

    public function setDhAlteracao($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->dh_alteracao):
            $this->dh_alteracao = $val;
        endif;
    }

}