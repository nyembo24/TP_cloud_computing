<?php
class depense{
    private $id;
    private $con;
    private $nom;
    private $montant;
    private $date;
    private $idl;
    private $idc;
    public function __construct($con){
        $this->con=$con;
    }
    public function set_id($id) : void{$this->id=$id;}
    public function set_idl($idl):void{$this->idl=$idl;}
    public function set_idc($idc):void{$this->idc=$idc;}
    public function set_nom($nom):void{$this->nom=$nom;}
    public function set_date($date):void{$this->date=$date;}
    public function set_montant($montant):void{$this->montant=$montant;}
    public function add_depense(){
        $ist=$this->con->prepare("insert into depenses(nom,idl,`date`,montant,idc) values(?,?,?,?,?)");
        if($ist->execute(array($this->nom,$this->idl,$this->date,$this->montant,$this->idc))){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function select_total(){
        $ist=$this->con->prepare("select sum(montant) as mt from depenses where idl=?");
        if($ist->execute(array($this->idl))){
            return $ist->fetch();
        }
    }

    public function select_categorie_nom(){
        $ist=$this->con->prepare("select idc,nom from catdep where idl=?");
        if($ist->execute(array($this->idl))){
            return $ist;
        }
    }
    public function select_depenses(){
        $ist=$this->con->prepare("select depenses.nom as nm,depenses.idd,depenses.montant,depenses.date,catdep.nom from depenses,catdep where depenses.idl=catdep.idl and depenses.idc=catdep.idc and depenses.idl=?");
        if($ist->execute(array($this->idl))){
            return $ist;
        }
    }
    public function del_depense(){
        $ist=$this->con->prepare("delete from depenses where idd=? and idl=?");
        if($ist->execute(array($this->id,$this->idl))){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function select_depenses_un(){
        $ist=$this->con->prepare("select depenses.nom as nm,depenses.montant,depenses.date,catdep.idc,catdep.nom from depenses,catdep where depenses.idd=? and catdep.idl=depenses.idl");
        if($ist->execute(array($this->id))){
            return $ist;
        }
    }
    public function update_depense(){
        $ist=$this->con->prepare("update depenses set nom=?,montant=?,date=?,idc=? where idd=? and idl=?");
        if($ist->execute(array($this->nom,$this->montant,$this->date,$this->idc,$this->id,$this->idl))){
            return 1;
        }
        else{
            return 0;
        }
    }
      
}