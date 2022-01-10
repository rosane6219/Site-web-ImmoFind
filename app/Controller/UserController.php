<?php
class UserController extends Controller{
    function connexion(){
        //unset($_SESSION['User']);
        //debug($this->Session->read());
        if($this->request->data){
            $data = $this->request->data;
            $data->pass = sha1($data->pass);
            $this->loadModel('User');
            $user = $this->User->findFirst(array(
                'condition' => array('mail' => $data->mail,'pass' => $data->pass)
            ));
            //debug($user);
            if(!empty($user)){
               $this->Session->write('User',$user);
            }
            $this->request->data->pass = '';
            //debug($data);
        }
        if($this->Session->isloged()){
            if($_SESSION['User']->admin == 1) {
                $this->redirect('admin/bien/list');
            } else {
                $this->redirect('accueil/index');
            }
        }
    }

    function logout(){
        unset($_SESSION['User']);
        $this->Session->setFlash(' Vous etes maintenant deconnecteé', 'SUCCESS');
        $this->redirect('accueil/index');
    }
    
    function inscription(){
        if($this->request->data){
            $this->loadModel('User');
            $data = $this->request->data;
            if(empty($this->User->find(array('condition' => array('mail' => $data->mail))))){
                if($this->User->validates($data)){
                    $data->pass = sha1($data->pass);
                    $data->admin = 0;
                    $id = $this->User->save($data);
                    $this->loadModel('Panier');
                    $panier = new stdClass();
                    $panier->id_client = $id;
                    $this->Panier->save($panier);
                    $this->Session->setFlash(' Inscription effectuée avec succès ! Vous pouvez maintenant vous connecter.','SUCCES');
                    $this->redirect('accueil/index');
                } else {
                    $this->Session->setFlash(' Merci de corriger vos erreurs ','ECHEC');
                }
            } else {
                $this->Session->setFlash(' Compte déjà existant. Veuillez choisir une adresse mail différente.','ECHEC');
            }
        }
    }
}