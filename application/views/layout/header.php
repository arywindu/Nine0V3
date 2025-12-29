<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'NINE 0 Studio' ?></title>
    <meta name="description" content="<?= isset($meta_description) ? $meta_description : 'NINE 0 Studio - Creative Design & Digital Marketing' ?>">
    <link rel="icon" type="image/png" href="<?= base_url('src/favIcon/favicon.jpg') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('main.css') ?>">
    <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url() ?>">NINE 0</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('portfolio') ?>">Portfolio</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="margin-top: 76px;"></div>
