<?= $this->extend('template/home') ?>

<?= $this->section('content') ?>

<div class="row mt-2">
    <div class="col ml-5">
        <h3><?= $judul ?></h3>
    </div>
</div>

<div class="row mt-2">

    <div class="col-11 ml-5">
        <h5>Anda Sudah Membeli : </h5>
        <table class="table table-bordered col-9">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Pesanan</th>
                <th scope="col">Jumlah</th>
            </tr>
            <?php $no=1; foreach ($order as $key => $value) : ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $value['menu'] ?></td>
                    <td><?= $value['jumlah'] ?></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="3"><h5>Anda Harus Membayar <?=number_format($order[0]['total']) ?></h5></td>
            </tr>
        </table>
    </div>
</div>

<?= $this->endSection() ?>