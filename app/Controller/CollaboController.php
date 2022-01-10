<?php

class CollaboController extends Controller
{



    public function index()
    {
        $this->loadModel('Collaborateur');
        $d['pages'] = $this->Collaborateur->find(array());
        $this->set($d);
    }

    public function view($id)
    {
        $this->loadModel('Collaborateur');
        $d['page'] = $this->Collaborateur->findFirst(array(
            'condition' => array('id' => $id)
        ));
        if (empty($d['page'])) { //empty($test)
            $this->e404('Page introuvable');
        } else {
        }
        //print_r($test);
        //$this->set('test',$test);
        //$d['pages']= $this->Collaborateur->find(array());//select *
        $this->set($d);
    }

    //recupère tt les enregistrement de la BDD
    public function getAll()
    {
        $this->loadModel('Collaborateur');
        return $this->Collaborateur->find(array());
    }

    /**
     * Fonction Backoffice
     */
    function admin_list()
    {
        $nb = 1;
        $this->loadModel('Collaborateur');
        //print_r($test);
        //$this->set('test',$test);
        $d['pages'] = $this->Collaborateur->find(array(
            'fields' => 'id,poste ',
            //'limit' => $nb*($this->request->page),

        )); //select 
        $d['total'] = $this->Collaborateur->findCount();
        $d['page'] = ceil($d['total'] / $nb);
        $this->set($d);
    }

    function admin_delete($id)
    {
        $this->loadModel('Collaborateur');
        $this->Collaborateur->delete($id);
        $this->Session->setFlash(' le contenu a bien été supprimé', 'SUCCES');
        $this->redirect('admin/collabo/list');
    }



    public function admin_edit($id = null)
    {
        $this->loadModel('Collaborateur');
        $d['id'] = '';
        if ($this->request->data) {
            //if($this->Bien->validates($this->request->data)){
            $error = "";
            if ($fileName = uploadImage($_FILES['image'], $error)) {
                $this->request->data->url = $fileName;
            } else {
                $this->Session->setFlash($error, 'ECHEC');
            }
            $this->Collaborateur->save($this->request->data);
            $this->Session->setFlash(' le contenu a bien été sauvegardé', 'SUCCES');
            $id = $this->Collaborateur->id;
            //}else { $this->Session->setFlash(' Veuillez bien remplir tt les champs ','ECHEC');}

        } else {
            if ($id) {
                $this->request->data = $this->Collaborateur->findFirst(array(
                    'condition' => array('id' => $id)
                ));
                $d['id'] = $id;
            }
        }
        $this->set($d);
    }
}
