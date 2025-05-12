<?php $class = \App\Shared\Http\Session::getFlash('old') ?? $this->class; ?>

<?php include(__DIR__ . '/../layouts/admin/header.php') ?>

    <div class="container">

        <form class="card" method="POST" autocomplete="off"
              action="<?= $class->id ?? false ? "/admin/classes/update" : '/admin/classes/create' ?>">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5>Turma</h5>
                    <div>
                        <a class="btn btn-sm btn-secondary me-1" type="button" href="/admin/classes">
                            <i class="bi bi-box-arrow-left me-1"></i>
                            Voltar
                        </a>
                        <?php if ($class->id ?? false) : ?>
                            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#enrollmentModal">
                                <i class="bi bi-journals me-2"></i>
                                Matricular Aluno
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label required" for="nome">Nome</label>
                    <input value="<?= $class->name ?? '' ?>" type="text" class="form-control" name="nome"
                           id="nome"
                           placeholder="Nome da turma" required>
                </div>
                <div class="form-group">
                    <label class="form-label required" for="descricao">Descrição</label>
                    <textarea class="form-control" rows="5" name="descricao" id="descricao" placeholder="Descrição"
                              required><?= $class->description ?? '' ?></textarea>
                </div>
                <?php include(__DIR__ . '/../csrf-token-input.php') ?>
                <?php if ($class->id ?? false) : ?>
                    <input type="hidden" name="id" value="<?= $class->id ?>">
                <?php endif; ?>
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-primary">
                    Gravar
                </button>
            </div>
        </form>
        <?php if ($this->enrollments) : ?>
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Alunos</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                        <?php foreach ($this->enrollments as $enrollment) : ?>
                            <tr>
                                <td><?= $enrollment->student ?></td>
                                <td class="text-end">
                                    <form method="POST"
                                          action="/admin/classes/delete-enrollment?enrollment_id=<?= $enrollment->id ?>&class_id=<?= $this->class->id ?>">
                                        <button class="btn btn-sm btn-danger">
                                            Desmatricular
                                        </button>
                                        <?php include(__DIR__ . '/../csrf-token-input.php') ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Enrollment Modal -->
    <div class="modal fade" id="enrollmentModal" tabindex="-1" aria-labelledby="enrollmentModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" autocomplete="off" action="/admin/classes/enroll">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="enrollmentModalLabel">Matricular Aluno</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label required" for="student_id">Aluno</label>
                        <select class="form-select" name="student_id" id="student_id" required>
                            <option value="">Selecione um aluno</option>
                            <?php foreach ($this->students as $student) : ?>
                                <option value="<?= $student->id ?>"><?= $student->name ?> (<?= $student->email ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="class_id" value="<?= $this->class->id ?>">
                        <?php include(__DIR__ . '/../csrf-token-input.php') ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Matricular</button>
                </div>
            </form>
        </div>
    </div>


<?php include(__DIR__ . '/../layouts/admin/footer.php') ?>