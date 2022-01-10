<?php

class BienController extends Controller
{



    public function index()
    {
        $nb = 2;
        $this->loadModel('Bien');
        //print_r($test);
        //$this->set('test',$test);
        $d['pages'] = $this->Bien->find(array(
            'orderby' => 'modif',
            'order' => 'DESC',
            'limit' => $nb * ($this->request->page),

        )); //select 
        $d['total'] = $this->Bien->findCount();
        $d['page'] = ceil($d['total'] / $nb);
        $this->set($d);
    }


    public function view($id)
    {
        $this->loadModel('Bien');
        $d['page'] = $this->Bien->findFirst(array(
            'condition' => array('id' => $id)
        ));
        if (empty($d['page'])) { //empty($test)
            $this->e404('Page introuvable');
        } else {
        }
        //$image_to_display = downloadImage($d['page']->url); 
        $this->set($d);
    }

    function search()
    {
        $this->loadModel('Bien');
        if ($this->request->data) {
            //$data = $this->request->data;
            unset($this->request->data->submit);
            $data = array();
            foreach ($this->request->data as $k => $v) {
                if (!empty($v)) $data[$k] = $v;
            }
            $d['pages'] = $this->Bien->find(array(
                'condition' => $data
            ));
            //$d['res'] = $this->Bien->cherche($data);
        } else {
            $d['pages'] = $this->Bien->find(array());
        }
        $this->set($d);
    }

    /**
     * Fonction Backoffice
     */
    function admin_list()
    {
        $nb = 1;
        $this->loadModel('Bien');
        //print_r($test);
        //$this->set('test',$test);
        $d['pages'] = $this->Bien->find(array(
            'fields' => 'id,titre ',
            //'limit' => $nb*($this->request->page),
            'orderby' => 'modif',
            'order' => 'DESC'
        )); //select 
        $d['total'] = $this->Bien->findCount();
        $d['page'] = ceil($d['total'] / $nb);
        $this->set($d);
    }

    function admin_delete($id)
    {
        $this->loadModel('Bien');
        $this->Bien->delete($id);
        $this->Session->setFlash(' le contenu a bien été supprimé', 'SUCCES');
        $this->redirect('admin/bien/list');
    }


    /*
    public function admin_edit($id=null){
        debug($_GET);
        $this->loadModel('Bien');
        $d['id'] = '';
        if($this->request->data){
            //if($this->Bien->validates($this->request->data)){
                $error = "";
                if($fileName = uploadImage($_FILES['image'], $error)){
                    $this->request->data->url = $fileName;
                    $this->request->data->slug = str_replace('--','-',str_replace(' ','-',preg_replace("/[^a-zA-Z 0-9]+/","",strtolower($this->request->data->titre))));
                    $this->request->data->modif = date("Y-m-d");
                    //$this->Bien->save($this->request->data);
                    $this->Session->setFlash(' le bien a été sauvegardé','SUCCES');
                    $id = $this->Bien->id;
                    //}else { $this->Session->setFlash(' Veuillez bien remplir tt les champs ','ECHEC');}
                } else {
                    $this->Session->setFlash($error,'ECHEC');
                }
        }else{
            if($id){
                $this->request->data = $this->Bien->findFirst(array(
                    'condition' => array('id' => $id)
                ));
                $d['id'] = $id;
            }
        }
        $this->set($d);
    }*/

    public function admin_edit($id = null)
    {
        $this->loadModel('Bien');
        $d['id'] = '';
        if ($this->request->data) {
            if($this->Bien->validates($this->request->data)){
                $error = "";
                if ($fileName = uploadImage($_FILES['image'], $error)) {
                    $this->request->data->url = $fileName;
                } else {
                    $this->Session->setFlash($error, 'ECHEC');
                }
                $this->request->data->slug = str_replace('--', '-', str_replace(' ', '-', preg_replace("/[^a-zA-Z 0-9]+/", "", strtolower($this->request->data->titre))));
                $this->request->data->modif = date("Y-m-d");
                $this->Bien->save($this->request->data);
                $this->Session->setFlash(' le bien a été sauvegardé', 'SUCCES');
                $id = $this->Bien->id;
            }else { 
                $this->Session->setFlash(' Merci de corriger vos erreurs ','ECHEC');
            }

        } else {
            if ($id) {
                $this->request->data = $this->Bien->findFirst(array(
                    'condition' => array('id' => $id)
                ));
                $d['id'] = $id;
            }
        }
        $this->set($d);
    }
}
