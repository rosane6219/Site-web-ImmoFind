<?php

class AccueilController extends Controller{
 
    

    public function index() { // Affiche Les 10 derniers bien creés ou modifiés
        $nb = 10;
        $this->loadModel('Bien');
        //$condition =  array('datemodif' => 'location');
        //print_r($test);
        //$this->set('test',$test);
        $d['pages']= $this->Bien->find(array(
            'orderby' => 'modif',
            'order' => 'DESC',
            'limit' => $nb,
            
        ));//select *
        if(empty($d['pages'])){//empty($test)
            $this->e404('Page introuvable');
        }
        //$d['total']= $this->Bien->findCount($condition);//select *
        $this->set($d);
        $this->render('accueil');
    }
    
   
}
