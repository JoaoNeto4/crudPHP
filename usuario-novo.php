<?php
    // antes de entrar na pagina verifica o kookie se o usuario fez login e esta autenticado
    // o armazenamento deste kookie esta na pagina de validaLogin.php
  
    $email = "";
    $senha= "";


    if (!isset($_COOKIE['email'])) {
        header("Location:login.php");
    }

    if ($_GET['edicao']) {
        $id = $_GET['edicao'];

        require_once "conexao.php";

        $sql = "SELECT * FROM usuario WhERE codigo =?";
        
        $stmt = mysqli_prepare($conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $id);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $usuario = mysqli_fetch_assoc($resultado);

        $codigo = $usuario['codigo'];
        $email = $usuario['email'];
       
    }


?>

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
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body class="sb-nav-fixed">
        

        <?php   include_once("topo.php");     ?>

        <div id="layoutSidenav">
            



            <?php   include_once("menu.php");     ?>





            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Usuário</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Usuário</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <a href="usuario-lista.php" type="button" class="btn btn-outline-primary">Lista de Usuários</a>
                            </div>
                        </div>

    <!-- AQUIIIII  -->
                        <?php if (isset($_GET['sucesso'])) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Usuário cadastrado com <strong>sucesso!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>


                        <?php if (isset($_GET['erro'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Não foi possível realizar o cadastro
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>

                        <?php if (isset($_GET['senhadif'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                As senhas não conferem. Tente novamente
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>


                        <?php if (isset($_GET['atual'])) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Usuário atualizado com <strong>sucesso!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>

                        <?php if (isset($_GET['existe'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Usuario ja cadastrado. Tente novamente
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>

    <!-- AQUIIIII   -->
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Novo Usuário</div>
                            <div class="card-body">
                                <form action="cadastroUsuario.php" method="POST">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="email">Email Login</label>
                                                        <input class="form-control" name="email" id="email" value="<?php echo $email ?>" type="text" placeholder="E-mail" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="senha">Senha</label>
                                                        <input class="form-control" name="senha" id="senha" type="password" value="" aria-describedby="emailHelp" placeholder="Informe sua senha" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="senha">Confirma Senha</label>
                                                        <input class="form-control" name="conf_senha" id="conf_senha" type="password" value="" aria-describedby="emailHelp" placeholder="Confirma a senha" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group mt-4 mb-0">
                                                    <input type="submit" name="btn-cadastrar" class="btn btn-primary btn-block" value="Salvar">
                                            </div>
                                        </form>
                            </div>
                        </div>
                    </div>
                </main>
                



                <?php include_once("rodape.php")   ?>




            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
