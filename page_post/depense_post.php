<?php
session_start();
if(! isset($_SESSION["id"]) and empty($_SESSION["id"])){
    header("location:../index.php");
    exit;
}
require_once("../connexion/conn.php");
require_once("depense.php");
$db=new connexion();
$con=$db->getconnexion();
$class_depense =new depense($con);
if(isset($_GET["mod"]) and !empty($_GET["mod"])){
    $class_depense->set_idl($_SESSION["id"]);
    $class_depense->set_id(htmlspecialchars($_GET["mod"]));
    $class_depense->set_nom(htmlspecialchars($_POST["nom"]));
    $class_depense->set_montant(htmlspecialchars($_POST["montant"]));
    $class_depense->set_date(htmlspecialchars($_POST["date"]));
    $class_depense->set_idc(htmlspecialchars($_POST["cat"]));
    if($class_depense->update_depense()){
        $sms="modification effectuer avec succès";
    }
    else{
        $sms="echec de modification";
    }
    header("location:../page/depense.php?sms=$sms");
    exit;
}
if(isset($_POST["nom"])and isset($_POST["date"])){
    $class_depense->set_nom(htmlspecialchars($_POST["nom"]));
    $class_depense->set_montant(htmlspecialchars($_POST["montant"]));
    $class_depense->set_date(htmlspecialchars($_POST["date"]));
    $class_depense->set_idc(htmlspecialchars($_POST["cat"]));
    $class_depense->set_idl($_SESSION["id"]);
    if($class_depense->add_depense()){
        $sms="enregistrement effectuer avec succès";
    }
    else{
        $sms="echec d'enregistrement";
    }
    header("location:../page/depense.php?sms=$sms");
    exit;

}
if(isset($_GET["sup"]) and ! empty($_GET["sup"])){
    $class_depense->set_id(htmlspecialchars($_GET["sup"]));
    $class_depense->set_idl($_SESSION["id"]);
    if($class_depense->del_depense()){
        $sms="suppression effectuer avec succès";
    }
    else{
        $sms="echec de suppression";
    }
    header("location:../page/depense.php?sms=$sms");
    exit;

}
header("location:../page/depense.php");
exit;