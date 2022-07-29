<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-4">
            <h4>Login Admin</h4>
            <a>
                <form class="px-4 py-3" action="admin.php">
                    <div class="mb-3">
                        <label for="exampleDropdownFormEmail1" class="form-label">Username :</label>
                        <input type="text" class="form-control" id="exampleDropdownFormEmail1" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label for="exampleDropdownFormPassword1" class="form-label">Password :</label>
                        <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
                    </div>
                    <br>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="dropdownCheck">
                            <label class="form-check-label" for="dropdownCheck">
                                Remember me
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>
            </a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>