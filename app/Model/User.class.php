<?php

class User extends Model{
    public $table = 'accout';

    var $validate = array(
        'pass' => array(
            'rule' => 'isStrong',
            'message' => 'Le mot de passe doit contenir au moins 8 charactères, dont au moins 1 lettre minuscule, 1 lettre majuscule et 1 chiffre.'
        )/*,
        'pass' => array(
            'rule' => 'hasNumber',
            'message' => 'Le mot de passe doit contenir au moins 1 chiffre.'
        ),
        'pass' => array(
            'rule' => 'hasLetter',
            'message' => 'Le mot de passe doit contenir au moins 1 lettre.'
        ),
        'pass' => array(
            'rule' => 'hasLower',
            'message' => 'Le mot de passe doit contenir au moins 1 lettre minuscule.'
        ),
        'pass' => array(
            'rule' => 'hasCapital',
            'message' => 'Le mot de passe doit contenir au moins 1 lettre majuscule.'
        ),*/
    );   
}
?>