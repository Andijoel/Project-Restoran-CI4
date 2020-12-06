<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/bootstrap/css/bootstrap.min.css') ?>">
    <title>Restoran SMK</title>
</head>

<body style="overflow-x: hidden;">

    <div class="container">
        <div class="row mt-2">
            <div class="col">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="<?= base_url() ?>">
                        <h2>Restoran SMK</h2>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <?php if (!empty(session()->get('pelanggan')) && !empty(session()->get('email'))) { ?>
                                <li class="nav-item  ml-2"><a class="btn btn-primary" href="<?= base_url('/front/homepage/histori') ?>">Histori</a></li>
                                <li class="nav-item mt-2 ml-2"> Cart(<a href="<?= base_url('/front/Beli') ?>"><?= $cart ?></a>)</li>

                                <li class="nav-item mt-2 ml-3"> Pelanggan : </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"> <?= session()->get('pelanggan'); ?> <span class="sr-only">(current)</span></a>
                                </li>

                                <li class="nav-item mt-2 ml-2"> Email : </li>
                                <li class="nav-item mt-2 ml-1">
                                    <?= session()->get('email'); ?>
                                </li>

                                <li class="nav-item ml-3">
                                    <a href="<?= base_url('/login/logout') ?>" class="btn btn-danger">Logout</a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item mt-2 ml-5"><a href="<?= base_url('/front/homepage/create') ?>" class="btn btn-success">Daftar</a></li>
                                <li class="nav-item mt-2 ml-5"><a href="<?= base_url('/login') ?>" class="btn btn-primary">Login</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row pl-3 pt-3">
            <div class="col-3">
                <div class="mt-2" style="width: 15rem;">
                    <h3>Kategori</h3>
                    <hr>
                    <div class="list-group">
                        <?php foreach ($kategori as $key) : ?>
                            <a href="<?= base_url('/front/homepage/read/' . $key['idkategori'] . '')  ?>" class="list-group-item list-group-item-action text-decoration-none"><?= $key['kategori'] ?></a>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="col-9 px-2">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <p class="text-center">2020 - copyright@smkrevit.com</p>
        </div>
    </div>


    <script src="<?= base_url('/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

</body>

</html>