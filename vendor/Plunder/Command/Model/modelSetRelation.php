    /**
     * [set{phpName} Return the relation table {phpName}]
     * @return [{phpName}] [$this->a{phpName}]
     */
    public function {set}{phpName}({phpName} $val){
        $this->a{phpName}     = $val;
        $this->{mod}Relations[] = '{phpName}';
    }