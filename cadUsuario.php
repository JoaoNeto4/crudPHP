<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>IFPR Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>


                    <?php if (isset($_GET['senhadif'])) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            As senhas não conferem. Tente novamente
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>



                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><h1>Cadastro de usuário</h1></h3></div>
                                    <div class="card-body">
                                        <form action="validaLogin.php" method="POST">
                                            <div class="form-group">
                                                <label class="small mb-1" for="email">Email</label>
                                                <input class="form-control py-4" name="email" id="email" type="email" placeholder="Digite seu e-mail" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="senha">Senha</label>
                                                <input class="form-control py-4" name="senha" id="senha" type="password" placeholder="Digite sua senha" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="senha">Confirma Senha</label>
                                                <input class="form-control py-4" name="confirmasenha" id="confirmasenha" type="password" placeholder="Confirme sua senha" />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input type="submit" name="btn-cadastrar" class="btn btn-primary" value="Cadastrar">
                                            </div>
                                            


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    </body>
</html>
