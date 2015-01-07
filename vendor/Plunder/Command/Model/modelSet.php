    /**
     * [set{phpName} Set the field table {varname}]
     * @param [{type}] $val 
     */
    public function set{phpName}($val){ 
        if($val !== null)  $val = ({type}) $val; 

        if($val !== $this->{varname}):
            $this->{varname} = $val;
            $this->modColumns[] = '{var_name}';
        endif;
    }
    