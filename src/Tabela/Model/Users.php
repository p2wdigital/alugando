<?php 
namespace Tabela\Model; 
use Tabela\Model\Clientes;
use Plunder\ORM\ActiveRecord;

class Users extends ActiveRecord{ 

    protected $tableName    = 'user';
    protected $className    = 'User';
    protected $modColumns   = array();
    protected $modRelations = array();
    protected $addRelations = array();
    protected $new          = null;
    protected $updated      = null;
    protected $deleted      = null;
    protected $aUser        = null;

    /** 
    * The value for the cliente_id field.
    * @var        int
    */ 
    protected $cliente_id; 

    /** 
    * The value for the password field.
    * @var        int
    */ 
    protected $password; 

    /** 
    * The value for the salt field.
    * @var        string
    */ 
    protected $salt; 

    /** 
    * The value for the email field.
    * @var        string
    */ 
    protected $email; 

    /** 
    * The value for the testeenum field.
    * @var        string
    */ 
    protected $testeenum; 

    /** 
    * The value for the usercol field.
    * @var        string
    */ 
    protected $usercol; 

    public function getClienteId(){ 
        return $this->cliente_id;
    }

    public function getPassword(){ 
        return $this->password;
    }

    public function getSalt(){ 
        return $this->salt;
    }

    public function getEmail(){ 
        return $this->email;
    }

    public function getTesteenum(){ 
        return $this->testeenum;
    }

    public function getUsercol(){ 
        return $this->usercol;
    }
    public function getCliente(){ 
        return $this->aCliente;
    }

    public function setClienteId($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->cliente_id):
            $this->cliente_id = $val;
            $this->modColumns[] = 'cliente_id';
        endif;
    }

    public function setPassword($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->password):
            $this->password = $val;
            $this->modColumns[] = 'password';
        endif;
    }

    public function setSalt($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->salt):
            $this->salt = $val;
            $this->modColumns[] = 'salt';
        endif;
    }

    public function setEmail($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->email):
            $this->email = $val;
            $this->modColumns[] = 'email';
        endif;
    }

    public function setTesteenum($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->testeenum):
            $this->testeenum = $val;
        endif;
    }

    public function setUsercol($val){ 
        if($val !== null)  $val = (string) $val; 

        if($val !== $this->usercol):
            $this->usercol = $val;
        endif;
    }
    public function addCliente(Clientes $val){
        $this->aCliente = $val;
        $this->addRelations[] = 'Cliente';
    }

    protected function getMapRelations($table){
        $relations = array(
            'Cliente'=>array('id'=>'cliente_id'),
        );

        return $relations[$table];
    }

    protected function getColumnsMap(){
        return array(
            'ClienteId'     => 'cliente_id',
            'Password'      => 'password',
            'Salt'          => 'salt',
            'email'         => 'email',
        );

    }
    protected function getAutoIncrement(){
        return array();
    }
}