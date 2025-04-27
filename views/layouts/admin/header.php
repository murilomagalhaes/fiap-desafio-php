<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
        <?php require(__DIR__ . '/../../../public/app.css') ?>
    </style>
    <title>Secretaria FIAP</title>
</head>
<body class="bg-light">

<div class="pb-5 main">
    <div class="bg-fiap-gray text-fiap-red px-4 py-2">
        <h1 class="my-auto">FIAP</h1>
    </div>

    <nav class="navbar navbar-expand-lg border-bottom bg-white shadow-sm">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item border-end pe-2 me-2">
                        <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/dashboard') !== false ? 'active' : '' ?>"
                           aria-current="page" href="/admin/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/classes') !== false ? 'active' : '' ?>"
                           href="/admin/classes">Turmas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/students') !== false ? 'active' : '' ?>"
                           href="/admin/students">Alunos</a>
                    </li>
                </ul>
            </div>
            <form method="POST" action="/logout">
                <?php include(__DIR__ . '/../../csrf-token-input.php') ?>
                <button class="btn">
                    Sair
                    <i class="bi bi-box-arrow-in-right"></i>
                </button>
            </form>
        </div>
    </nav>

    <?php if (\App\Shared\Http\Session::hasFlash('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
            <?= \App\Shared\Http\Session::getFlash('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (\App\Shared\Http\Session::hasFlash('error')) : ?>
        <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
            <?= \App\Shared\Http\Session::getFlash('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (\App\Shared\Http\Session::hasFlash('errors')) : ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
            <ul class="my-auto">
                <?php foreach (\App\Shared\Http\Session::getFlash('errors') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
