<?php include(__DIR__ . '/../layouts/admin/header.php') ?>

    <div class="container">

        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Alunos</h3>
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <a class="btn btn-sm btn-secondary me-2" href="/admin/dashboard">
                            <i class="bi bi-box-arrow-left me-2"></i>
                            Voltar
                        </a>
                        <a class="btn btn-sm btn-primary" href="/admin/students/form">
                            Cadastrar Aluno
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="input-group mb-4" action="/admin/students" method="GET">
                    <input type="text" class="form-control" placeholder="Pesquisar por nome"
                           aria-label="Nome da turma" name="search" aria-describedby="btn-search" value="<?= $_GET['search'] ?? '' ?>">
                    <a class="btn btn-outline-secondary" id="btn-reload" href="/admin/students">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                    <button class="btn btn-outline-primary" type="submit" id="btn-search">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Nascimento</th>
                        <th>Turmas</th>
                        <th class="w-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!$this->students->records) : ?>
                        <tr>
                            <td colspan="6">Nenhum registro encontrado</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($this->students->records as $student) : ?>
                            <tr>
                                <td><?= $student->name ?></td>
                                <td><?= $student->email ?></td>
                                <td><?= substr($student->cpf, 0, 3) . str_repeat('*', strlen($student->cpf) - 3); ?></td>
                                <td><?= (new \DateTime($student->birth_date))->format('d/m/Y') ?></td>
                                <td><?= $student->enrollments_count ?></td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            Ações
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item link-primary"
                                                   href="/admin/students/form?id=<?= $student->id ?>">
                                                    Ver / Editar
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST"
                                                      action="/admin/students/delete?id=<?= $student->id ?>">
                                                    <?php include(__DIR__ . '/../csrf-token-input.php') ?>
                                                    <button class="dropdown-item link-danger">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if ($this->students->totalPages): ?>
                <div class="card-footer d-flex justify-content-end bg-white">
                    <ul class="pagination my-auto">
                        <li class="page-item">
                            <a class="page-link <?= $this->students->currentPage === 1 ? 'disabled' : '' ?>"
                               href="/admin/students?page=<?= $this->students->currentPage - 1 ?>"
                               aria-label="Next">
                                <span aria-hidden="true">Anterior</span>
                            </a>
                        </li>
                        <?php foreach (range(1, $this->students->totalPages) as $page) : ?>
                            <li class="page-item <?= $page === $this->students->currentPage ? 'active' : '' ?>">
                                <a class="page-link" href="/admin/students?page=<?= $page ?>">
                                    <?= $page ?>
                                </a>
                            </li>
                        <?php endforeach; ?>

                        <li class="page-item">
                            <a class="page-link <?= $this->students->currentPage === $this->students->totalPages ? 'disabled' : '' ?>"
                               href="/admin/students?page=<?= $this->students->currentPage + 1 ?>"
                               aria-label="Next">
                                <span aria-hidden="true">Próxima</span>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>


<?php include(__DIR__ . '/../layouts/admin/footer.php') ?>