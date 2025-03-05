<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../PHP/boostrap/dist/css/bootstrap.css">
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
    <div class="col-lg-3 offset-4 mt-5">
        <center>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">login</h3>
                </div>
                <div class="card-body">
                    <form action="page_post/login_post.php" method="post">
                        <label for="" class="form-label">username</label>
                        <input autocomplete="off" name="uusr" type="text" class="form-control">
                        <label for="" class="form-label">password</label>
                        <input autocomplete="off" name="ppwd" type="password" class="form-control">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-danger w-100 mt-3">connecter</button>
                            </div>
                        </div>
                    </form>
                        <div class="col-lg-6">
                            <?php include_once("page/modal.php"); ?>
                        </div>
                </div>
            </div>
        </center>
    </div>
    <script src="../PHP/boostrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>
