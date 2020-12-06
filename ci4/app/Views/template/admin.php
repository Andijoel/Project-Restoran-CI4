<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/bootstrap/css/bootstrap.min.css') ?>">
    <title>Admin Page</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col mt-2">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                   
                            <a class="navbar-brand" href="<?= base_url('/admin') ?>">Dashboard</a>
                     
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div style="margin-left: 22rem;" class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item mt-2 ml-5"> User : </li>
                            <li class="nav-item mr-4">
                                <a class="nav-link" href="#"><?php
                                                                if (!empty(session()->get('user'))) {
                                                                    echo session()->get('user');
                                                                }
                                                                ?> <span class="sr-only">(current)</span></a>
                            </li>

                            <li class="nav-item mt-2 ml-5"> Email : </li>
                            <li class="nav-item mt-2">
                                <?php
                                if (!empty(session()->get('email'))) {
                                    echo session()->get('email');
                                }
                                ?>
                            </li>

                            <li class="nav-item mt-2 ml-5"> Level : </li>
                            <li class="nav-item mt-2 ml-2">
                                <?php
                                if (!empty(session()->get('level'))) {
                                    echo session()->get('level');
                                    $level = session()->get('level');
                                }
                                ?>
                            </li>

                            <li class="nav-item mt-2 ml-2">
                                <a href="<?=base_url('admin/login/logout') ?>">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-4">
                
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                    <?php if($level==="admin"): ?>
                        
                        
                        <li class="list-group-item"><a href="<?= base_url('/admin/kategori') ?>">Kategori</a></li>
                        <li class="list-group-item"><a href="<?= base_url('/admin/menu') ?>">Menu</a></li>
                        <li class="list-group-item"><a href="<?= base_url('/admin/pelanggan') ?>">Pelanggan</a></li>
                        <li class="list-group-item"><a href="<?= base_url('/admin/order') ?>">Order</a></li>
                        <li class="list-group-item"><a href="<?= base_url('/admin/orderdetail') ?>">Order Detail</a></li>
                        <li class="list-group-item"><a href="<?= base_url('/admin/user') ?>">User</a></li>
                    <?php endif ;?>

                    <?php if($level==="kasir"): ?>
                        <li class="list-group-item"><a href="<?= base_url('/admin/order') ?>">Order</a></li>
                        <li class="list-group-item"><a href="<?= base_url('/admin/orderdetail') ?>">Order Detail</a></li>
                    <?php endif ;?>

                    <?php if($level==="koki"): ?>
                        <li class="list-group-item"><a href="<?= base_url('/admin/orderdetail') ?>">Order Detail</a></li>
                    <?php endif ;?>
                    </ul>
                    
                </div>
                
            </div>
            <div class="col-8 px-2">
                <?= $this->renderSection('content') ?>
            </div>
            
        </div>
        
    </div>




</body>

</html>