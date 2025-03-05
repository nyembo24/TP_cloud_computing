<?php 
session_start();
if(! isset($_SESSION["id"]) and empty($_SESSION["id"])){
    header("location:../index.php");
    exit;
}
require_once("../connexion/conn.php");
require_once("../page_post/depense.php");
$db=new connexion();
$con=$db->getconnexion();
$class_depense =new depense($con);
$class_depense->set_idl($_SESSION["id"]);
$cat_data=$class_depense->select_categorie_nom();
$total=$class_depense->select_total();
$data_depense=$class_depense->select_depenses();
if(isset($_GET["mod"]) && !empty($_GET["mod"])){
    $class_depense->set_id(htmlspecialchars($_GET["mod"]));
    $class_depense->set_idl($_SESSION["id"]);
    $data_ones=$class_depense->select_depenses_un()->fetch();
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
        function validateMontant() {
            var montant = document.getElementById("montant").value.trim();
            var regex = /^[0-9]+(\.[0-9]+)?$/;
            if (!montant || !regex.test(montant)) {
                alert("Veuillez entrer un montant valide. ex: 1.2 ou 1");
                return false;
            }
            return true;
        }

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
        <div class="col-lg-4 p-3">
            <div class="card offset-1">
                <?php if(isset($_GET["mod"]) && !empty($_GET["mod"])){ ?>
                <!-- ///////////////// -->
                <div class="card-header">
                    <h3 class="text-center">modifier une dépenses</h3>
                </div>
                <div class="card-body">
                    <form action="../page_post/depense_post.php?mod=<?= htmlspecialchars($_GET['mod']) ?>" method="post" onsubmit="return validateMontant()">
                        <label class="form-label" for="">Nom</label>
                        <input value="<?= $data_ones["nm"] ?>" autocomplete="off" name="nom" required placeholder="Nom de la dépense" class="form-control" type="text">
                        <label class="form-label mt-2" for="">Montant</label>
                        <input value="<?= $data_ones["montant"] ?>" autocomplete="off" name="montant" id="montant" placeholder="Montant de la dépense" class="form-control" type="text">
                        <label class="form-label mt-2" for="">Date</label>
                        <input autocomplete="off" name="date" value="<?= $data_ones["date"] ?>" required class="form-control" type="date">
                        <div class="mb-3">
                            <label for="" class="form-label">catégorie</label>
                            <select
                                class="form-select form-select-lg"
                                name="cat"
                                id=""
                                required
                            >
                            <?php while($catdt=$cat_data->fetch()){ ?>
                                <option value="<?= $catdt["idc"] ?>" selected><?= $catdt["nom"] ?></option>
                            <?php }?>
                            </select>
                        </div>
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
                <!-- ////////// -->
                <?php } else{?>
                <div class="card-header">
                    <h3 class="text-center">ajouter une dépenses</h3>
                </div>
                <div class="card-body">
                    <form action="../page_post/depense_post.php" method="post" onsubmit="return validateMontant()">
                        <label class="form-label" for="">Nom</label>
                        <input autocomplete="off" name="nom" required placeholder="Nom de la dépense" class="form-control" type="text">
                        <label class="form-label mt-2" for="">Montant</label>
                        <input autocomplete="off" name="montant" id="montant" placeholder="Montant de la dépense" class="form-control" type="text">
                        <label class="form-label mt-2" for="">Date</label>
                        <input autocomplete="off" name="date" value="<?= date("Y-m-d"); ?>" required class="form-control" type="date">
                        <div class="mb-3">
                            <label for="" class="form-label">catégorie</label>
                            <select
                                class="form-select form-select-lg"
                                name="cat"
                                id=""
                                required
                                title="ajouter le catégori"
                            >
                            <?php while($catdt=$cat_data->fetch()){ ?>
                                <option value="<?= $catdt["idc"] ?>" selected><?= $catdt["nom"] ?></option>
                            <?php }?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 mt-3">enregistrer</button>
                        
                    </form>
                </div>
                <?php }?>
            </div>
        </div>
        <div class="col-lg-7 p-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">liste de dépence</h3>
                </div>
                <div class="card-body">
                    <div
                        class="table-responsive"
                    >
                        <table
                            class="table table-striped-columns table-hover table-borderless table-primary align-middle"
                        >
                            <thead class="table-light">
                                <caption>
                                    Table Name
                                </caption>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Montant</th>
                                    <th>Catégorie</th>
                                    <th>modifier</th>
                                    <th>supprimer</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php $i=0; while($datas=$data_depense->fetch()){ $i++;?>
                                <tr
                                    class="table-primary"
                                >
                                    <td><?= $i ?></td>
                                    <td><?= $datas["nm"] ?></td>
                                    <td><?= $datas["montant"] ?></td>
                                    <td><?= $datas["nom"] ?></td>
                                    <td><a class="btn btn-primary" href="?mod=<?= $datas["idd"] ?>">modifier</a></td>
                                    <td><a class="btn btn-secondary" onclick="if(! confirm('Voulez-vous vraiment supprimer cet enregistrement ?')) return false;" href="../page_post/depense_post.php?sup=<?= $datas["idd"] ?>">supprimet</a></td>
                                </tr>
                                <tr>
                                    <td colspan="5">TOTAL</td>
                                    <td><?= $total["mt"] ?></td>
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