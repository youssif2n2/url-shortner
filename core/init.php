<?php

spl_autoload_register(function($class){
    require_once"classes\\$class.php";
});

$config = array(
    'database' => array( // new PDO('mysql://host=localhost;dbname=test' , 'username' , 'password');
        'host'      => 'localhost' ,
        'dbname'    => 'try',
        'username'  => 'root',
        'password'  => ''
    )
);

function dumping($var){
    echo '<pre>';
    var_dump($var);
    echo '<pre>';
}
