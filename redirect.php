<?php

require_once 'core\\init.php';

$input = new Input('GET');

if($input->check() && $input->exists('code')){
    $go = new Redirect($input->get('code'));
    $go->go();
} else{
    header('location:localhost/url/register.php');
}