<?php include(__DIR__ . '/../layouts/errors/header.php') ?>

    <h1 class="text-fiap-red">HTTP 404</h1>
    <h2 class="text-white">Página não encontrada</h2>


<?php if ($this->message) : ?>
    <p class="text-white my-4 border p-4 rounded bg-secondary"><?= $this->message ?></p>
<?php endif ?>


<?php include(__DIR__ . '/../layouts/errors/footer.php') ?>