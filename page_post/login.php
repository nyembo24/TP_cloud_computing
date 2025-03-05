<?php
class login{
    private $id;
    private $con;
    private $usr;
    private $pwd;
    public function __construct($con){
        $this->con=$con;
    }
    public function set_id($id) : void{$this->id=$id;}
    public function set_usr($usr):void{$this->usr=$usr;}
    public function set_pwd($pwd):void{$this->pwd=$pwd;}
    public function add_user(){
        $ist=$this->con->prepare("insert into login(usr,pwd) values(?,?)");
        $pwdd=password_hash($this->pwd,PASSWORD_DEFAULT);
        if($ist->execute(array($this->usr,$pwdd))){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function verifier_pwd(){
        $ist=$this->con->prepare("select * from login where usr=?");
        $ist->execute(array($this->usr));
        if($pwds=$ist->fetch()){
            if(password_verify($this->pwd,$pwds["pwd"])){

                session_start();
                $_SESSION["id"]=$pwds["idl"];
                header("location:../page/depense.php");
                exit;
            }
        }
        header("location:../index.php?sms=nom d'utilisateur ou mots de passe incorecter");
        exit;
    }
}