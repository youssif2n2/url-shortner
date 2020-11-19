<?php
require_once 'core\\init.php';

$redirector = 'localhost/url/redirect.php?code=';

$input = new Input();
if($input->check() && $input->exists('url')){
    if(filter_var($input->get('url') ,FILTER_VALIDATE_URL)){
        if($input->counts() > 1){
            $link = '';
            foreach($input->get('notexexex') as $param => $value){
                $link .= $param . "=" . $value . "&";
                $link = trim($link , 'url=');
            }
        }else{
            $link = $input->get('url');
        }
        
        $url = new URL($link);
        if(!$url->checkurl()){
            $code = new Code();
            $code = $code->generate();
            if($url->inserturl($code))
                echo $redirector . $code;
            else echo 'something went wrong ';
        }else{
            echo $redirector . $url->get();
        }
    }else{
        echo 'please enter a valid url';
    }
}else{
    header('Location:register.php');
    exit();
}