<?php include(__DIR__ . '/../layouts/guest/header.php') ?>


    <div class="vh-100 d-flex flex-column">
        <div class="bg-fiap-gray text-fiap-red px-4 py-2">
            <h1 class="my-auto">FIAP</h1>
        </div>

        <?php if (\App\Shared\Http\Session::hasFlash('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
                <?= \App\Shared\Http\Session::getFlash('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="col-11 col-md-8 col-xl-6 mt-5 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h2>Login</h2>
                    <small>Secretaria <strong class="text-fiap-red">FIAP</strong></small>
                </div>
                <div class="card-body p-4">
                    <form class="d-flex flex-column gap-3" method="POST" action="/login">
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email"
                                   placeholder="Insira seu email" required/>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Senha</label>
                            <input class="form-control" id="password" type="password" name="password"
                                   placeholder="Insira sua senha" required/>
                        </div>
                        <?php include(__DIR__ . '/../csrf-token-input.php') ?>
                        <button class="btn btn-primary">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php include(__DIR__ . '/../layouts/guest/footer.php') ?>