<?php
include_once("connexion/conn.php");

$db = new connexion();
$con =$db->getconnexion();
$erreur=[];
if(isset($_POST["envoyer"])){

   
    $usr=htmlspecialchars($_POST["usr"]);
    $pwd=htmlspecialchars($_POST["pwd"]);



    if(! empty( $usr) && ! empty($pwd))
    {
            $inserer_bd=$con->prepare("INSERT INTO login(usr,pwd) VALUES(?,?)");
            $cond=$inserer_bd->execute(array($usr,$pwd));

            if($cond==true)
            {
                $message="enregistrement avec succes ";
                header("location:index.php?message=$message");
            }else
            {
                $message=" echec de l'enregistrement ";
                header("location:../index.php?message=$message");
            }

    }
