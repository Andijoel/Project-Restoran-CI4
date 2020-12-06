<?= $this->extend('template/home') ?>

<?= $this->section('content') ?>
<div class="row mt-5">
    <div class=" mx-auto">
        <div class="col">
            <?php
            if (!empty($info)) {
                echo '<div class="alert alert-danger" role="alert">';
                echo $info;
                echo '</div>';
            }
            ?>
        </div>
        <span>
            <h2>LOGIN PELANGGAN</h2>
        </span>
        <hr>
        <form action="<?= base_url('/login') ?>" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" required class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" required class="form-control" id="password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" name="login" value="LOGIN">
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>