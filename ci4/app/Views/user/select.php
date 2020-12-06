<?= $this->extend('template/admin') ?>

<?= $this->section('content') ?>

<?php
if (isset($_GET['page_page'])) {
    $page = $_GET['page_page'];
    $jumlah = 3;
    $no = ($jumlah * $page) - $jumlah + 1;
} else {
    $no = 1;
}
?>

<div class="row">
    <div class="col-4">
        <a href="<?= base_url('/admin/user/create') ?>" class="btn btn-primary" role="button">TAMBAH DATA</a>
    </div>
    <div class="col">
        <h3> <?= $judul; ?> </h3>
    </div>
</div>



<div class="row mt-2">

    <div class="col">
        <table class="table">

            <tr>
                <th>No</th>
                <th>User</th>
                <th>Email</th>
                <th>Level</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>
            <?php $no; ?>
            <?php foreach ($user as $key => $value) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $value['user'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td><?= $value['level'] ?></td>
                    <?php 
                        if ($value['aktif']==1) {
                            $aktif= "AKTIF";
                        } else {
                            $aktif= "BANNED";
                        }
                    ?>
                    <td><a href="<?= base_url() ?>/admin/user/update/<?= $value['iduser'] ?>/<?= $value['aktif'] ?>"><?=$aktif ?></a>
                    </td>
                    <td><a href="<?= base_url() ?>/admin/user/delete/<?= $value['iduser'] ?>"><img src="<?= base_url('/icon/can.svg'); ?>" alt=""></a>
                        <a href="<?= base_url() ?>/admin/user/find/<?= $value['iduser'] ?>"><img src="<?= base_url('/icon/pen.svg'); ?>" alt=""></a></td>
                </tr>
            <?php endforeach ?>

        </table>
    

    <?= $pager->links('page', 'bootstrap') ?>
    </div>

</div>

<?= $this->endSection() ?>