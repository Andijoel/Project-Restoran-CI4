<?= $this->extend('template/home') ?>

<?= $this->section('content') ?>
<div class="row mt-2">
    <div class="col">
        <h3><?= $judul ?></h3>
        <?php $no = 1 + $mulai; ?>
        <table class="table table-bordered w-50 mt-4">

            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Menu</th>
                <th>Harga</th>
                <th>Jumlah</th>

            </tr>
            <?php foreach ($detail as $key => $value) : ?>
                <tr>
                    <td><?=$no++ ?></td>
                    <td><?=$value['tglorder'] ?></td>
                    <td><?=$value['menu'] ?></td>
                    <td><?=$value['harga'] ?></td>
                    <td><?=$value['jumlah'] ?></td>
                </tr>
            <?php endforeach ?>
        </table>
        <?= $pager->makeLinks(1, $tampil, $total, 'bootstrap') ?>
    </div>
</div>
<?= $this->endSection() ?>