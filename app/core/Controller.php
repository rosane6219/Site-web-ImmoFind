<?php
class Controller{
    
    public $request;
    private $vars = array();
    public $layout = 'default';
    private $rendered = false;

    function __construct($request = null)
    {
        if($request){
            $this->request = $request;
            require ROOT.DS.'config'.DS.'hook.php';
        }

    }

    public function render($view){
        if($this->rendered) { return false; }
        extract($this->vars);
        if (strpos($view,'/')===0){
            $view = ROOT.DS.'View'.$view.'.php';
        }else{
            $view = ROOT.DS.'View'.DS.$this->request->controller.DS.$view.'.php';
        }
        //$view = ROOT.DS.'View'.DS.$this->request->controller.DS.$view.'.php';
        
        ob_start();
        require($view);
        $content_for_layout = ob_get_clean();
        ob_start();
        //require ROOT.DS.'webroot'.DS.'css'.DS.'style.css';
        require ROOT.DS.'webroot'.DS.'css'.DS.'bootstrap.min.css';
        
        //require ROOT.DS.'View'.DS.'css'.DS.'main.css';
        $style_for_content = ob_get_clean();
        require ROOT.DS.'View'.DS.'layout'.DS.$this->layout.'.php';
        $this->rendered = true;
    }

    // affectation key(le nom de la variable) = value (la valeur)
    public function set($key,$value = null){
        if (is_array($key)){
            $this->vars += $key;
        }else{
            $this->vars[$key] = $value;
        }   
    }

    public function loadModel($name){
        if (!isset($this->$name)){
            $file = ROOT.DS.'Model'.DS.$name.'.class.php';
            require_once($file);
            $this->$name = new $name();
            if(isset($this->Form)){
                $this->$name->Form = $this->Form;
            }
        }else{
            echo 'Déjà chargé';
        }
    }
    //gerer les erreur 404
    public function e404($message){
        header("HTTP/1.0 404 NOT FOUND");
        $this->set('message',$message);
        $this->render('/error/404');
        die();
    }

    //Afficher un message à l'utilisateur
    public function message($message){
        $this->set('message',$message);
        $this->render('/error/message');
        die();
    }
    
    //permet d'appeler un controller dans une view
    public function request($controller,$action){
        $controller = ucfirst($controller).'Controller' ;
        require_once ROOT.DS.'Controller'.DS.$controller.'.php';
        $c = new $controller(); 
        return $c->$action();
    }
     
    public function redirect($url,$code=null){
        if ($code == 301){
            header("HTTP/1.1 301 Moved Permantly");
        }
        header("Location: ".Router::url($url));
    }
}
?>