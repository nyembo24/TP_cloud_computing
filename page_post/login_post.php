<?php
require_once("../connexion/conn.php");
require_once("login.php");
$db=new connexion();
$con=$db->getconnexion();
$class_login =new login($con);
var_dump($_POST);
if(isset($_POST["uusr"]) and isset($_POST["ppwd"])){
    $class_login->set_usr(htmlspecialchars($_POST["uusr"]));
    $class_login->set_pwd(htmlspecialchars($_POST["ppwd"]));
    $class_login->verifier_pwd();
}
if(isset($_POST["usr"]) and isset($_POST["pwd"])){
    $class_login->set_usr(htmlspecialchars($_POST["usr"]));
    $class_login->set_pwd(htmlspecialchars($_POST["pwd"]));
    if($class_login->add_user()){
        $sms="utilisateur crée avec succes";
    }
    else{
        $sms="echec de creation de l'utilisateur";
    }
    header("location:../index.php?sms=$sms");
    exit;
}
header("location:../index.php");
exit;
