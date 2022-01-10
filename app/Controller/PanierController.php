<?php

class PanierController extends Controller{
 
    

    public function index($id) {
        $this->loadModel('Panier');
        $d['panier']= $this->Panier->find(array(
            'condition' => array('id_client' => $id),
            'join' => array(
                array('panier_bien', 'id_panier', 'id'),
                array('bien', 'id', 'id_bien')
            )
        ));
        if(empty($d['panier'])){
            $this->message('Panier vide');
        }
        $this->set($d);
    }

    public function delete($id){
       // debug('delete');die();
        $this->loadModel('PanierBien');
        $this->PanierBien->delete($id);
        $this->Session->setFlash(' Le bien a été supprimé du panier','SUCCES');
        $this->redirect("panier/index/id:{$_SESSION['User']->id}");
    }

    public function add($userid, $bienid){
        $this->loadModel('Panier');
        $d = $this->Panier->findFirst(array(
            'condition' => array('id_client' => $userid),
            'fields' => 'id '
        ));
        $this->loadModel('PanierBien');
        $data = new stdClass();
        $data->id_panier = $d->id;
        $data->id_bien = $bienid;
        if(empty($this->PanierBien->find(array('condition' => array('id_panier' => $d->id, 'id_bien' => $bienid))))) {
            $this->PanierBien->save($data);
            $this->Session->setFlash(' Le bien a été ajouté dans le panier','SUCCES');
        } else {
            $this->Session->setFlash(' Le bien existe deja dans le panier','SUCCES');
        }
        $this->redirect(pathinfo($_SERVER['HTTP_REFERER'],PATHINFO_BASENAME));
        //$id = $this->PanierBien->id; 
        //$this->set($data);
    }
}
