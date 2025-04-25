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

<div class="vh-100 d-flex flex-column">
    <div class="bg-fiap-gray text-fiap-red px-4 py-2">
        <h1 class="my-auto">FIAP</h1>
    </div>

    <nav class="navbar navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Turmas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Alunos</a>
                    </li>
                </ul>
            </div>
            <div>
                <button class="btn">
                    Sair
                    <i class="bi bi-box-arrow-in-right"></i>
                </button>
            </div>
        </div>
    </nav>