<?php include(__DIR__ . '/../layouts/admin/header.php') ?>

    <div class="container">

        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Turmas</h3>
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <a class="btn btn-sm btn-secondary me-2" href="/admin/dashboard">
                            <i class="bi bi-box-arrow-left me-2"></i>
                            Voltar
                        </a>
                        <a class="btn btn-sm btn-primary" href="/admin/classes/form">
                            Criar Turma
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="input-group mb-4" action="/admin/classes" method="GET">
                    <input type="text" class="form-control" placeholder="Pesquisar por nome"
                           aria-label="Nome da turma" name="search" aria-describedby="btn-search" value="<?= $_GET['search'] ?? '' ?>">
                    <a class="btn btn-outline-secondary" id="btn-reload" href="/admin/classes">
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
                        <th>Descrição</th>
                        <th>Alunos</th>
                        <th class="w-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!$this->classes->records) : ?>
                        <tr>
                            <td colspan="4">Nenhum registro encontrado</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($this->classes->records as $class) : ?>
                            <tr>
                                <td><?= $class->name ?></td>
                                <td><?= $class->description ?></td>
                                <td><?= $class->students_count ?></td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            Ações
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item link-primary"
                                                   href="/admin/classes/form?id=<?= $class->id ?>">
                                                    Ver / Editar
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST"
                                                      action="/admin/classes/delete?id=<?= $class->id ?>">
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
            <?php if ($this->classes->totalPages): ?>
                <div class="card-footer d-flex justify-content-end bg-white">
                    <ul class="pagination my-auto">
                        <li class="page-item">
                            <a class="page-link <?= $this->classes->currentPage === 1 ? 'disabled' : '' ?>"
                               href="/admin/classes?page=<?= $this->classes->currentPage - 1 ?>"
                               aria-label="Next">
                                <span aria-hidden="true">Anterior</span>
                            </a>
                        </li>
                        <?php foreach (range(1, $this->classes->totalPages) as $page) : ?>
                            <li class="page-item <?= $page === $this->classes->currentPage ? 'active' : '' ?>">
                                <a class="page-link" href="/admin/classes?page=<?= $page ?>">
                                    <?= $page ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <li class="page-item">
                            <a class="page-link <?= $this->classes->currentPage === $this->classes->totalPages ? 'disabled' : '' ?>"
                               href="/admin/classes?page=<?= $this->classes->currentPage + 1 ?>"
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