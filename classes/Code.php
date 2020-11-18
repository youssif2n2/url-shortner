<?php

class Code{
    private $_db;
    
    public function __construct(){
        $this->_db = new DB();
    }
    
    public function generate(){
        $code = uniqid(rand(100000 , 999999) , false);
        $this->_db->select('urls' , array('code' => $code));
        if($this->_db->counts() > 0){
            return $this->generate();
        }
        return $code;
    }
}