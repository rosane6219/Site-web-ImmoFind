<?php
class Session{
    public function __construct(){
        if (!isset($_SESSION)){
            session_start();
        }
    }

    public function setFlash($message,$type){
        $_SESSION['flash'] =array(
            'message' => $message,
            'type' => $type
        );
    }

    public function flash(){
        if (isset($_SESSION['flash']['message'])){
            $html = '<div class="alert-message"><p>'.$_SESSION['flash']['type'].$_SESSION['flash']['message'].'</p></div>';
            $_SESSION['flash'] = array();
            return $html;
        }
    }

    public function write($key,$value){
        $_SESSION[$key] = $value;
    }

    public function read($key = null){
        if ($key){
            if (isset($_SESSION[$key])){
                return $_SESSION[$key];
            }else{
                return false;
            }
        }else{
            return $_SESSION;
        }
    }

    public function isloged(){
        return isset($_SESSION['User']->id);
    }
}