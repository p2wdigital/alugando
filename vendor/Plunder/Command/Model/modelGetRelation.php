    /**
     * [get{phpName} Return the relation table {phpName}]
     * @return [{phpName}] [$this->a{phpName}]
     */
    public function get{phpName}(){ 
        if ($this->a{phpName} instanceof {phpName}):
		   return $this->a{phpName};
        else:
            return null;
        endif;
    }
