<?php 
session_start();
if(! isset($_SESSION["id"]) and empty($_SESSION["id"])){
    header("location:../index.php");
    exit;
}
require_once("../connexion/conn.php");
require_once("../page_post/page.php");
$db=new connexion();
$con=$db->getconnexion();
$class_categori =new categori($con);
$class_categori->set_idl($_SESSION["id"]);
$datas=$class_categori->select_categorie();
if(isset($_GET["mod"]) and ! empty($_GET["mod"])){
    $class_categori->set_id(htmlspecialchars($_GET["mod"]));
    $one_data=$class_categori->select_categorie_un()->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../PHP/boostrap/dist/css/bootstrap.css">
    <script>
         const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('sms') && urlParams.get('sms').trim() !== "") {
            setTimeout(() => {
                alert(urlParams.get('sms'));
                window.location.href = "?";
            }, 62);
        }
    </script>
</head>
<body>
    <?php include_once("../navbar.php"); ?>
    <div class="row">
        <div class="col-lg-4">
            <?php if(isset($_GET["mod"]) and ! empty($_GET["mod"])){?>
            <div class="card offset-1">
                <div class="card-header">
                    <h3 class="text-center">Modifier une catégorie</h3>
                </div>
                <div class="card-body">
                    <form action="../page_post/pages_post.php" method="post">
                        <input type="hidden" name="idmod" value="<?= $_GET["mod"] ?>">
                        <input value="<?= $one_data["nom"]?>" class="form-control" name="cat" type="text" autocomplete="off" required>
                        <div class="row">
                            <div class="col-lg-6 p-4">
                                <button class="btn btn-danger w-100">Modifier</button>
                            </div>
                            <div class="col-lg-6">
                                <a href="?" class="btn btn-danger mt-4 w-100">annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php }else{?>
            <div class="card offset-1">
                <div class="card-header">
                    <h3 class="text-center">ajouter une catégorie</h3>
                </div>
                <div class="card-body">
                    <form action="../page_post/pages_post.php" method="post">
                        <input class="form-control" name="cat" type="text" autocomplete="off" required>
                        <button class="btn btn-danger mt-2 w-100">ajouter</button>
                    </form>
                </div>
            </div>
            <?php }?>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">liste de catégorie</h3>
                </div>
                <div class="card-body">
                    <div
                        class="table-responsive"
                    >
                        <table
                            class="table table-striped table-hover table-borderless table-primary align-middle"
                        >
                            <thead class="table-light">
                                <caption>
                                    Table Namejjjj
                                </caption>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>modifier</th>
                                    <th>supprimer</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr
                                    class="table-primary"
                                >
                                <?php $i=0; while($data=$datas->fetch()){ $i++; ?>
                                   <td><?= $i ?></td>
                                   <td><?= $data["nom"]?></td>
                                   <td><a class="btn btn-primary" href="?mod=<?=  $data["idc"]?>">modifier</a></td>
                                   <td><a class="btn btn-secondary" onclick="if(! confirm('Voulez-vous vraiment supprimer cet enregistrement ?')) return false;" href="../page_post/pages_post.php?supcat=<?= $data["idc"]?>">supprimer</a></td>
                                </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                
                            </tfoot>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>