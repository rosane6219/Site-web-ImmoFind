<?php

class Client extends User{

    public function __construct($n,$p,$m,$s,$a)
    {
        parent::__construct($n,$p,$m,$s,$a);
    }

    public function singIn(){}
    public function logIn(){}
}
?>