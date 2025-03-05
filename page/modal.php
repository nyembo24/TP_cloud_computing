<!-- Modal trigger button -->
<button
    type="button"
    class="btn btn-success w-100 mt-3"
    data-bs-toggle="modal"
    data-bs-target="#modalId"
>
    s'inscrire
</button>

<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div
    class="modal fade"
    id="modalId"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
>
    <div
        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-body">
        <center>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">s'inscrire</h3>
                </div>
                <div class="card-body">
                    <form action="page_post/login_post.php" method="post">
                        <label  for="" class="form-label">username</label>
                        <input autocomplete="off" required name="usr" type="text" class="form-control">
                        <label for="" class="form-label">password</label>
                        <input autocomplete="off" required name="pwd" type="password" class="form-control">
                        <label for="" class="form-label">email</label>
                        <input autocomplete="off" name="mail" type="email" class="form-control">
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <button class="btn btn-primary w-100 btn-sm">enregistrer</button>
                            </div>
                            <div class="col-lg-6">
                                <button
                                type="button"
                                class="btn btn-secondary w-100 btn-sm"
                                data-bs-dismiss="modal"
                                aria-label="Close">annuler</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </center>
            </div>
        </div>
    </div>
</div>

<!-- Optional: Place to the bottom of scripts -->
<script>
    const myModal = new bootstrap.Modal(
        document.getElementById("modalId"),
        options,
    );
</script>
