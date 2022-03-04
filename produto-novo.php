<?php


    if (!isset($_COOKIE['email'])){
        header("Location:login.php");
    }

    session_start();
    session_destroy();


    include_once "conexao.php";
    
    $sql_categoria = "SELECT * FROM categoriaproduto";
    $resultado_categoria = mysqli_query($conexao, $sql_categoria);




   
    $codigo = 0;
    $categoria = 0;
    $descricaoprod = "";
    $precounit = 0.0;
    


    if ($_GET['edicao']) {
        $id = $_GET['edicao'];

        require_once "conexao.php";

        $sql = "SELECT * FROM produto WHERE codigo = ?";
        
        $stmt = mysqli_prepare($conexao, $sql);

        mysqli_stmt_bind_param($stmt, "i", $id);

        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        $produto = mysqli_fetch_assoc($resultado);

        $codigo = $produto['codigo'];
        $categoria = $produto['categoria'];
        $descricaoprod = $produto['descricaoprod'];
        $precounit= $produto['precounit'];
        
       
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        

        <?php   include_once("topo.php");     ?>

        <div id="layoutSidenav">
            


            <?php   include_once("menu.php");     ?>



            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Produto</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Produto</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
								<a href="produto-lista.php" type="button" class="btn btn-outline-primary">Lista de Produtos</a>
							</div>
                        </div>

    <!-- AQUIIIII  -->
                        <?php if (isset($_GET['sucesso'])) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Produto cadastrado com <strong>sucesso!</strong>
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


                        <?php if (isset($_GET['atual'])) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Produto atualizado com <strong>sucesso!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>

    <!-- AQUIIIII   -->
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Novo Produto</div>
                            <div class="card-body">
                                <form action="cadastroProduto.php" method="POST">

                                    <input class="form-control" name="codigo" id="codigo" value="<?php echo $codigo;?>" type="hidden" />
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
														<label class="small mb-1" for="descricaoprod">Produto</label>
														<input class="form-control" name="descricaoprod" id="descricaoprod" value="<?php echo $descricaoprod; ?>" type="text" placeholder="Descrição produto" />
													</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
														<label class="small mb-1" for="tipo">Valor Unit.</label>
                                                        <input class="form-control" name="precounit" id="precounit" value="<?php echo $precounit; ?>" type="text" placeholder="Valor" />
													</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="categoria">Categoria</label>
                                                        <select id="categoria" name="categoria" class="form-control select-categoria" >
                                                            <option selected disabled>Selecione...</option>
                                                                <?php 

                                                                    while ($dados = mysqli_fetch_array($resultado_categoria)) {

                                                                        if ($categoria == $dados['codigo']) {
                                                                            $seleciona = 'selected="selected"';
                                                                        }else{
                                                                            $seleciona = '';
                                                                        }
                                                                        echo '<option value="'.$dados['codigo'].'" '.$seleciona.'> '.$dados['descricao'].'</option>';
                                                                    }

                                                                 ?>                                                           
                                                        </select>
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
                

                <?php   include_once("rodape.php");     ?>


            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        


    </body>
</html>
