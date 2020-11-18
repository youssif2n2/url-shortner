<?php

class Input{
    private $_method;
    
    public function __construct($method = 'POST'){
        $this->_method = ($method == 'POST') ? $_POST : $_GET;
    }
    
    public function check(){
        return (!empty($this->_method));
    }
    
    public function exists($item){
        return (isset($this->_method[$item]));
    }
    
    public function get($item){
        return ($this->exists($item) ? $this->_method[$item] : false);
    }
}