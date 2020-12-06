<?= $this->extend('template/home') ?>

<?= $this->section('content') ?>
<div class="row mt-2">
    <div class="col">
        <?php foreach ($kategori as $key) : ?>
            <?php if ($id == $key['idkategori']) : ?>
                <h3 class="text-uppercase"><?= $judul . ' ' . $key['kategori'] ?></h3>
            <?php endif ?>
        <?php endforeach ?>
        <?php foreach ($menu as $key) : ?>
            <div class="card" style="width: 15rem; float:left; margin:10px;">
                <img src="<?= base_url('/upload/' . $key['gambar'] . '') ?>" class="card-img-top" style="height: 150px;" alt="">
                <div class="card-body">
                    <h5 class="card-title"><?= $key['menu'] ?></h5>
                    <p class="card-text"><?= number_format($key['harga'])  ?></p>
                    <a href="<?= base_url('/front/beli/index/' . $key['idmenu'] . '') ?>" class="btn btn-success" role="button">Beli</a>
                </div>
            </div>
        <?php endforeach ?>
        <div style="clear: both;">
            <?= $pager->makeLinks(1, $tampil, $total, 'bootstrap') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>