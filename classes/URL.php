<?php

class URL{
    private $_db,
            $_url;
    
    public function __construct($url){
        $this->_db = new DB();
        $this->_url = $url;
    }
    
    public function checkurl(){
        $this->_db->select('urls' , array('url' => $this->_url));
        if($this->_db->counts() > 0){
            $this->_url = $this->_db->result()[0]->code;
            return true;
        }else return false;
    }
    
    public function get(){
        return $this->_url;
    }
    
    public function inserturl($code){
        return $this->_db->insert('urls' , array(
            'url' => $this->_url,
            'code' => $code
        ));
    }
}