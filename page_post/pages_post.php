<?php
session_start();
if(! isset($_SESSION["id"]) and empty($_SESSION["id"])){
    header("location:../page/categori.php");
    exit;
}
require_once("../connexion/conn.php");
require_once("page.php");
$db=new connexion();
$con=$db->getconnexion();
$class_categori =new categori($con);
if(isset($_POST['idmod']) and ! empty($_POST["idmod"])and isset($_POST["cat"])){
    $class_categori->set_id(htmlspecialchars($_POST["idmod"]));
    $class_categori->set_nom(htmlspecialchars($_POST["cat"]));
    $class_categori->set_idl($_SESSION["id"]);
    if($class_categori->update_categorie()){
        $sms="modification effectuer avec succès";
    }
    else{
        $sms="echec de modification";

    }
    header("location:../page/categori.php?sms=$sms");
    exit;

}
if(isset($_POST["cat"]) and isset($_SESSION["id"]) and !empty($_SESSION["id"])){
    $class_categori->set_nom(htmlspecialchars($_POST["cat"]));
    $class_categori->set_idl($_SESSION["id"]);
    if($class_categori->add_categorie()){
        $sms="enregistrement effectuer avec succès";
    }
    else{
        $sms="echec d'enregistrement";
    }
    header("location:../page/categori.php?sms=$sms");
    exit;
}
if(isset($_GET["supcat"]) and isset($_SESSION["id"]) and !empty($_SESSION["id"])){
    $class_categori->set_id(htmlspecialchars($_GET["supcat"]));
    $class_categori->set_idl($_SESSION["id"]);
    if($class_categori->verififier_avant_de_del()==1){
        if($class_categori->del_categorie()){
            $sms="suppression effectuer avec succès";
        }
        else{
            $sms="echec de suppression";
        }
        header("location:../page/categori.php?sms=$sms");
        exit;
    }
    else{
        $sms="impossibe cette catégori est utiliser dans une dépense";
    }
}
header("location:../page/categori.php?sms=$sms");
exit;