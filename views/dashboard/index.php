<?php include(__DIR__ . '/../layouts/admin/header.php') ?>


    <div class="container">
        <h2 class="display-6">Olá, <?= \App\Shared\Http\Session::get('user')->name ?>!</h2>

        <div class="row my-4 row-gap-3">
            <div class="col-lg-6">
                <a class="card card-body shadow-sm" href="/admin/classes">
                    <div class="d-flex gap-3 align-items-center">
                        <i class="bi bi-journals fs-2"></i>
                        <h4>Turmas (<?= $this->classes_count ?>)</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg-6">
                <a class="card card-body shadow-sm" href="/admin/students">
                    <div class="d-flex gap-3 align-items-center">
                        <i class="bi bi-person fs-2"></i>
                        <h4>Alunos (<?= $this->students_count ?>)</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>


<?php include(__DIR__ . '/../layouts/admin/footer.php') ?>