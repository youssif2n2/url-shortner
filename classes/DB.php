<?php

class DB{
    private $_config,
            $_pdo,
            $_pdos,
            $_result,
            $_errors = [],
            $_count;
    
    public function __construct(){
        global $config;
        $this->_config = $config['database'];
        $this->_pdo = new PDO('mysql://host=' . $this->_config['host'] . ';dbname=' . $this->_config['dbname'] , $this->_config['username'] , $this->_config['password']);
    }
    
    private function implement($query , $values){
        $this->_pdos = $this->_pdo->prepare($query);
        foreach($values as $x => $value){
            $this->_pdos->bindValue($x+1 , $value);
        }
        if($this->_pdos->execute()){
            $this->_result = $this->_pdos->fetchAll(PDO::FETCH_OBJ);
            $this->_count = $this->_pdos->rowCount();
            return true;
        } else{
            $this->_errors[] = ' wrong';
            return false;
        }
    }
    
    private function prepare($action , $table , $params){
        $this->_count = 0;
        if($action == 'SELECT' || $action == 'DELETE')
            $query = "$action * FROM $table WHERE ";
        elseif($action == 'INSERT')
            $query = "INSERT INTO $table SET ";
        else {
            $this->_errors[] = 'action error';
            return false;
        }
        $values = [];
        foreach($params as $key => $value){
            $query .= "$key = ? ";
            $values[] = $value;
            if(count($values) < count($params))
                $query .= ',';
        }
        return $this->implement($query , $values);
    }
    
    public function update($table , $fields , $id){
        $this->_count = 0;
        $query = "update $table set ";
        $keys = array_keys($fields);
        foreach($keys as $x => $key){
            $query .= "$key = ?";
            if($x+1 < count($keys))
                $query .= ',';
        }
        $idname = array_keys($id)[0];
        $query .= " where $idname = ?";
        $values = array_values($fields);
        $values[] = array_values($id)[0];
        
        return $this->execute($query, $values);
    }
    
    public function select($table , $fields){
        return $this->prepare('SELECT' , $table, $fields);
    }
    
    public function delete($table , $fields){
        return $this->prepare('DELETE' , $table, $fields);
    }
    
    public function insert($table , $fields){
        return $this->prepare('INSERT' , $table, $fields);
    }
    
    public function result(){
        return $this->_result; // array of objects
    }
    
    public function counts(){
        return $this->_count;
    }
    
    public function lastid(){
        return $this->_pdo->lastinsertid();
    }
    
    public function errors(){
        return $this->_errors;
    }
    
}
    
