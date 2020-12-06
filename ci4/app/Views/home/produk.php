<?= $this->extend('template/home') ?>

<?= $this->section('content') ?>
<div class="row mt-2">
    <div class="col">
        <h2><?= $judul ?></h2>
        <?php foreach ($menu as $key) : ?>
            <div class="card" style="width: 15rem; float:left; margin:10px;">
                <img src="<?= base_url('/upload/' . $key['gambar'] . '') ?>" class="card-img-top" style="height: 150px;" alt="">
                <div class="card-body">
                    <h5 class="card-title"><?= $key['menu'] ?></h5>
                    <p class="card-text"><?= $key['harga'] ?></p>
                    <a href="<?= base_url('/front/beli/index/'.$key['idmenu'].'')?>" class="btn btn-success" role="button">Beli</a>
                </div>
            </div>
        <?php endforeach ?>
        <div style="clear: both;">
            <?= $pager->links('page', 'bootstrap') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>