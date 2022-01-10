<?php
// recuperer l'url et savoir quoi en faire 
class Dispatcher{

    var $request ;
    public function __construct()
    {
        $this->request = new Request();
        Router::parse($this->request->url,$this->request);//request contrient le nom du controlleur  
        $controller = $this->loadController();
        $action = $this->request->action;
        if ($this->request->prefix){
            $action = $this->request->prefix.'_'.$action;
        }
        if (!in_array($action, array_diff(get_class_methods($controller),get_class_methods('Controller')))){
            $this->error ('le controlleur '.$this->request->controller.'n\'a pas de methode '.$action);
        }
        call_user_func_array(array($controller,$action),$this->request->params);//
        //$controller->view();
        $controller->render($action);
    }

    function error($message){
        $controller = new Controller($this->request);
        $controller->Session = new Session();
        $controller->e404($message);
    }

    function loadController(){
        $name = ucfirst($this->request->controller).'Controller' ;
        $file = ROOT.DS.'Controller'.DS.$name.'.php';
        require $file;
        $controller = new $name($this->request);//new PageController (url)
         
        $controller->Session = new Session();
        $controller->Form = new Form($controller);
        return $controller;
    }
}
?>