<?php
class categori{
    private $id;
    private $nom;
    private $idl;
    private $con;
    public function __construct($con){
        $this->con=$con;
    }
    public function set_id($id) : void{$this->id=$id;}
    public function set_nom($nom):void{$this->nom=$nom;}
    public function set_idl($idl):void{$this->idl=$idl;}
    
    public function add_categorie(){
        $ist=$this->con->prepare("insert into catdep(nom,idl) values(?,?)");
        if($ist->execute(array($this->nom,$this->idl))){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function update_categorie(){
        $ist=$this->con->prepare("update catdep set nom=? where idc=? and idl=?");
        if($ist->execute(array($this->nom,$this->id,$this->idl))){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function select_categorie(){
        $ist=$this->con->prepare("select * from catdep where idl=?");
        if($ist->execute(array($this->idl))){
            return $ist;
        }
    }
    public function del_categorie(){
        $ist=$this->con->prepare("delete from catdep where idc=? and idl=?");
        if($ist->execute(array($this->id,$this->idl))){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function verififier_avant_de_del(){
        $ist=$this->con->prepare("select * from depenses where idc=?");
        $ist->execute(array($this->id));
        if($ist->fetch()){
            return 0;
        }
        else{
            return 1;
        }
    }
    public function select_categorie_un(){
        $ist=$this->con->prepare("select nom from catdep where idc=?");
        if($ist->execute(array($this->id))){
            return $ist;
        }
    }

 }