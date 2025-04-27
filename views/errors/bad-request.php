<?php include(__DIR__ . '/../layouts/errors/header.php') ?>

    <div class="text-center">
        <h1 class="text-fiap-red mb-2">HTTP 400</h1>
        <h2 class="text-white">Requisição inválida</h2>
    </div>


<?php if ($this->message) : ?>
    <p class="text-white my-4 border p-4 rounded bg-secondary text-center"><?= $this->message ?></p>
<?php endif ?>


<?php include(__DIR__ . '/../layouts/errors/footer.php') ?>