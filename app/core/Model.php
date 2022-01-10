<?php
class Model {

    static $connections = array();
    public $conf = 'default';
    public $table = false ;
    public $db;
    public $primarykey = 'id';
    public $id;
    public $errors = array();
    public $Form;

    public function __construct()
    {   
        //initialisation des var 
        if ($this->table === false ){
        $this->table = strtolower(get_class($this));// nom de la table doit etre = au nom de la classe 
        //debug($this->table);
        }
        // cnx à la BDD
        $conf = Conf::$databases[$this->conf];
        //debug($conf);
        if (isset(Model::$connections[$this->conf])) {
            $this->db = Model::$connections[$this->conf];
            //debug($this->db);
            return true;
        }
       try{
        $pdo = new PDO('pgsql:host='.$conf['host'].';port='.$conf['port'].';dbname='.$conf['database'].';',
            $conf['login'],
            $conf['password'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
        );
        //print_r($pdo);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);//pour gerer lurl n'importe quoi qui fou la merde dans la requete sql du genre where blabla -_-

        Model::$connections[$this->conf] = $pdo;
        $this->db = $pdo;
        //debug($this->db);
       }catch(PDOException $e){
           if (Conf::$debug >= 1) {
           die($e->getMessage());
           }else{
            die('Impossible de se connecter à la BDD');
           }
       }
       //echo "BDD chargéé et bien connetée";
      
    }

    public function validates($data){
        $errors = array();
        foreach($this->validate as $k=>$v){
            if (!isset($data->$k)){
                $errors[$k] = $v['message'];
            }else{
                if($v['rule'] == 'noEmpty')  {
                    if(empty($data->$k)){
                       $errors[$k] = $v['message'];
                    }
                }elseif($v['rule'] == 'isNumeric'){
                    if(!is_numeric($data->$k)){
                       $errors[$k] = $v['message'];
                    }
                }elseif($v['rule'] == 'isStrong'){
                    if (strlen($data->$k) < 8) {
                        $errors[$k] = 'Le mot de passe doit contenir au moins 8 charactères.';
                    } 
                    if (!preg_match("#[0-9]+#", $data->$k)) {
                        $errors[$k] = 'Le mot de passe doit contenir au moins un chiffre.';
                    } 
                    if (!preg_match("#[a-z]+#", $data->$k)) {
                        $errors[$k] = 'Le mot de passe doit contenir au moins 1 lettre minuscule.';
                    }
                    if (!preg_match("#[A-Z]+#", $data->$k)) {
                        $errors[$k] = 'Le mot de passe doit contenir au moins 1 lettre majuscule.';
                    } 
                }elseif($v['rule'] == 'notShort'){
                    if (strlen($data->$k) < 8) {
                        $errors[$k] = $v['message'];
                    }   
                }elseif($v['rule'] == 'hasNumber'){
                    if (!preg_match("#[0-9]+#", $data->$k)) {
                        $errors[$k] = $v['message'];
                    } 
                }elseif($v['rule'] == 'hasLetter'){
                    if (!preg_match("#[a-zA-Z]+#", $data->$k)) {
                        $errors[$k] = $v['message'];
                    }  
                }elseif($v['rule'] == 'hasLower'){
                    if (!preg_match("#[a-z]+#", $data->$k)) {
                        $errors[$k] = $v['message'];
                    }  
                }elseif($v['rule'] == 'hasCapital'){
                    if (!preg_match("#[A-Z]+#", $data->$k)) {
                        $errors[$k] = $v['message'];
                    }  
                }elseif(!preg_match('/^'.$v['rule'].'$/',$data->$k)){
                   $errors[$k] = $v['message'];
                }
            }
        }
        $this->errors = $errors;
        if(isset($this->Form)){
            $this->Form->errors = $errors;
        }
        if (empty($errors)){
            return true;
        }
        return false;
   }

    //******************SEARCH*******************//
    public function find($req){// $req = null
        //debug($req);
        $sql = 'SELECT ';//this->table contient le nom de la table dans la BDD
        
        if (isset($req['fields'])){
            if (is_array($req['fields'])){
                $sql .= implode(',', $req['fields']);//concatenation
            }else{
                $sql .= $req['fields'];
            }
        }else {
            $sql .= ' * ';
        }

        $sql .= 'FROM '.$this->table. ' ';//' as '.get_class($this).
 
        if(isset($req['join'])) {
            for ($join = 0; $join < count($req['join']); $join++) {
                $sql .= ' JOIN '.$req['join'][$join][0].' ON ';
                if($join == 0) $sql .= $this->table.'.'.$req['join'][$join][2].'='.$req['join'][$join][0].'.'.$req['join'][$join][1].' ';
                else $sql .= $req['join'][$join-1][0].'.'.$req['join'][$join][2].'='.$req['join'][$join][0].'.'.$req['join'][$join][1]. ' ';
            }
        }

        // construction de la condition
        //print_r($req['condition']);
        if(isset($req['condition'])) {
            //$sql .= 'WHERE '.$req['condition'];
            $sql .= 'WHERE ';
            if (!is_array($req['condition'])){
                $sql .=$req['condition'];
            }else{
                $cond = array();
                foreach($req['condition'] as $k=>$v){
                    if (!is_numeric($v) || $k == 'codepostal'){
                        $v= $this->db->quote($v);
                    }
                   $cond[] = "$k=$v";
                }
                if(isset($req['union']) && $req['union']){ // = Si $req['union'] existe et qu'il est à true
                    $sql .= implode(' OR ',$cond);
                } else {
                    $sql .= implode(' AND ',$cond);
                }
            }   
        }
        if (isset($req['orderby'])){//ordre compte fait attention à comment tu mets les attributs
            $sql .= ' ORDER BY ';
            if (is_array($req['orderby'])){
                $sql .= implode(',', $req['orderby']);//concatenation
            }else{
                $sql .= $req['orderby'].' ';
            }
            $sql .= $req['order'];
        }
        if (isset($req['limit'])){
            $sql .= ' LIMIT '.$req['limit'];
        }
        //debug($sql);//die();
        //die($sql);
        $pre = $this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll((PDO::FETCH_OBJ));
        //die($this->table);
    }
    //******************************* */
    public function findFirst($req){
        //debug($req);
        return current($this->find($req));//return le premier enregistrement qui est current 
    }

    //******************************* */
    public function findCount(){
        $res = $this-> findFirst(array(
            'fields' => 'COUNT('.$this->primarykey.') as count ',
        ));
        return $res->count;
    }
    //****************************** */
    public function delete($id){
        $sql = "DELETE FROM $this->table WHERE $this->primarykey = $id";
        //debug($sql);die();
        $this->db->query($sql);
    }
    //**************************** */
    
    public function save($data){
        $key = $this->primarykey;
        $fields = array();
        $champs = array();
        $values =array();
        $d = array();
        if (isset($data->$key)) {
            $this->id = $data->$key;
            unset($data->$key);
        }
        foreach($data as $k=>$v){
            $fields[ ]= " $k=:$k";
            $d[":$k"] = $v;
            $champs[]="$k";
            $values[]="'$v'";
        }
        if (isset($data->$key) && !empty($data->$key)){
            //$sql = 'UPDATE '.$this->table.' SET '.implode(',',$fields).', modif = NOW()'.' WHERE '.$key.'=:'.$key; 
            $sql = 'UPDATE '.$this->table.' SET '.implode(',',$fields).' WHERE '.$key.'=:'.$key; 
            //debug($sql);
            
            $action = 'update';
        }else{
            if (isset($data->$key)) {unset($data->$key);}
        //$sql = 'INSERT INTO '.$this->table.' SET '.implode(',',$fields).', modif = NOW()'; 
        //$sql = 'INSERT INTO '.$this->table.' ('.implode(',',$champs).' ,modif)  VALUES ('.implode(',',$values).', NOW())';
            if($key != 'id'){
                $champs[] = $key;
                $values[] = "'$this->id'";
            }
            $sql = 'INSERT INTO '.$this->table.' ('.implode(',',$champs).') VALUES ('.implode(',',$values).') RETURNING '.$key;
            $action = 'insert';
            //debug($sql);die();
        }
        //debug($data);
        //debug($sql);
        $pre = $this->db->prepare($sql);
        if ($action == 'update'){
            $pre->execute($d);
        }elseif($action == 'insert'){
    
            if($pre->execute()){
                //$this->id = $this->db->lastInsertId();
                $this->id = $pre->fetchColumn();
                return $this->id;
            }
        }
       
        return true;
        //$pre->execute();
       
    }

}