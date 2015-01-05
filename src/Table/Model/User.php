<?php 
namespace Table\Model; 
class User { 
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
    * @var        
    */ 
    protected $salt; 

    /** 
    * The value for the email field.
    * @var        
    */ 
    protected $email; 

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

    public function setClienteId($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->cliente_id):
            $this->cliente_id = $val;
        endif;
    }

    public function setPassword($val){ 
        if($val !== null)  $val = (int) $val; 

        if($val !== $this->password):
            $this->password = $val;
        endif;
    }

    public function setSalt($val){ 
        if($val !== null)  $val = () $val; 

        if($val !== $this->salt):
            $this->salt = $val;
        endif;
    }

    public function setEmail($val){ 
        if($val !== null)  $val = () $val; 

        if($val !== $this->email):
            $this->email = $val;
        endif;
    }

}