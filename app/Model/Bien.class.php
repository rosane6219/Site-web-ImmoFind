<?php
class Bien extends Model {
   
    var $validate = array(
        'titre' => array(
            'rule' => 'noEmpty',
            'message' => 'Vous devez préciser un titre'
        ),
        'ville' => array(
            'rule' => 'noEmpty',
            'message' => 'Vous devez préciser un ville'
        ),
        'codepostal' => array(
            'rule' => 'noEmpty',
            'message' => 'Vous devez préciser un code postal'
        ),
        'typeannonce' => array(
            'rule' => 'noEmpty',
            'message' => 'Vous devez préciser un type d\'annonce'
        ),
        'typebien' => array(
            'rule' => 'noEmpty',
            'message' => 'Vous devez préciser un type de bien'
        ),
        'prix' => array(
            'rule' => 'noEmpty',
            'message' => 'Vous devez préciser un prix'
        ),
        'prix' => array(
            'rule' => 'isNumeric',
            'message' => 'Le prix doit être un nombre'
        ),
    ); 
}

?>