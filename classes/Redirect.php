<?php

class Redirect{
    private $_code,
            $_db;
    
    public function __construct($code){
        $this->_code = $code;
        $this->_db = new DB();
    }
    
    public function go(){
        $this->_db->select('urls' , array('code' => $this->_code));
        if($this->_db->counts() === 1){
            header('Location:' . $this->_db->result()[0]->url);
            exit();
        }else{
            header("HTTP/1.0 404 Not Found");
            include('core\\error.php');
            exit();
        }
    }
}