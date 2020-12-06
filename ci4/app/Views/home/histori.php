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
                <th>Total</th>
                <th>Detail</th>

            </tr>
            <?php foreach ($vorder as $key => $value) : ?>
                <tr>
                    <td><?=$no++ ?></td>
                    <td><?=$value['tglorder'] ?></td>
                    <td><?=$value['total'] ?></td>
                    <td><a role="button" class="btn btn-success" href="<?=base_url('/front/homepage/detail/'.$value['idorder'].'') ?>">Detail</a></td>
                </tr>
            <?php endforeach ?>
        </table>
        <?= $pager->makeLinks(1, $tampil, $total, 'bootstrap') ?>
    </div>
</div>
<?= $this->endSection() ?>