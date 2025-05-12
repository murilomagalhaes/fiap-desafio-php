<?php $student = \App\Shared\Http\Session::getFlash('old') ?? $this->student; ?>

<?php include(__DIR__ . '/../layouts/admin/header.php') ?>

    <div class="container">

        <form class="card" method="POST" autocomplete="off"
              action="<?= $student->id ?? false ? "/admin/students/update" : '/admin/students/create' ?>">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5>Aluno</h5>
                    <div>
                        <a class="btn btn-sm btn-secondary me-1" type="button" href="/admin/students">
                            <i class="bi bi-box-arrow-left me-2"></i>
                            Voltar
                        </a>
                        <?php if ($student->id ?? false) : ?>
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
                    <input value="<?= $student->name ?? '' ?>" type="text" class="form-control" name="nome"
                           id="nome"
                           placeholder="Nome do aluno" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label required" for="email">Email</label>
                    <input value="<?= $student->email ?? '' ?>" type="email" class="form-control" name="email"
                           id="email"
                           placeholder="Email" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label required" for="cpf">CPF</label>
                    <input value="<?= $student->cpf ?? '' ?>" type="text" class="form-control" name="cpf"
                           id="cpf"
                           data-maska="###.###.###-##"
                           placeholder="CPF" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label required" for="data_de_nascimento">Data de Nascimento</label>
                    <input value="<?= $student->birth_date ?? '' ?>" type="date" class="form-control"
                           name="data_de_nascimento"
                           id="data_de_nascimento"
                           required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label required" for="senha">Senha</label>
                    <input type="password" class="form-control" name="senha"
                           id="senha"
                           placeholder="Senha de acesso">
                </div>
                <?php include(__DIR__ . '/../csrf-token-input.php') ?>
                <?php if ($student->id ?? false) : ?>
                    <input type="hidden" name="id" value="<?= $student->id ?>">
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
                    <h5>Turmas</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                        <?php foreach ($this->enrollments as $enrollment) : ?>
                            <tr>
                                <td><?= $enrollment->class_name ?></td>
                                <td class="text-end">
                                    <form method="POST"
                                          action="/admin/students/delete-enrollment?enrollment_id=<?= $enrollment->id ?>&student_id=<?= $this->student->id ?>">
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
            <form class="modal-content" method="POST" autocomplete="off" action="/admin/students/enroll">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="enrollmentModalLabel">Nova Matrícula</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label required" for="class_id">Turma</label>
                        <select class="form-select" name="class_id" id="class_id" required>
                            <option value="">Selecione uma turma</option>
                            <?php foreach ($this->classes as $class) : ?>
                                <option value="<?= $class->id ?>"><?= $class->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="student_id" value="<?= $this->student->id ?>">
                        <?php include(__DIR__ . '/../csrf-token-input.php') ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Matricular</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/maska@3/dist/cdn/maska.js"></script>
    <script>
        const {MaskInput} = Maska

        new MaskInput("[data-maska]");
    </script>


<?php include(__DIR__ . '/../layouts/admin/footer.php') ?>