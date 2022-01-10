<?php

class ConnexionController extends Controller{
 
    

    public function connect() {
        $this->render('connexion');
    }

    public function inscription(){
        $this->render('inscription');
    }
    
   
}