<?php
    
    if (!isset($_COOKIE['email'])){
        header("Location:login.php");
    }

    session_start();
    session_destroy();

    include_once "conexao.php";
    
    $sql_mesa = "SELECT * FROM mesa";
    $resultado_mesa = mysqli_query($conexao, $sql_mesa);

    $sql_garcom = "SELECT * FROM funcionario";
    $resultado_garcom = mysqli_query($conexao, $sql_garcom);

    $sql_produto = "SELECT * FROM produto";
    $resultado_produto = mysqli_query($conexao, $sql_produto);
/*
    $sql_comanda = "SELECT * FROM comanda";
    $resultado_comanda = mysqli_query($conexao, $sql_comanda);
*/
    $codigo = 0;
    $cod_mesa = 0;
    $cod_garcom = 0;
    $valortotal = 0.0;
    $nome_garcom = "";
    $id = 0;


    if (isset($_GET['edicao'])) {
        $id = $_GET['edicao'];
       // $nomeGarcom= $_GET['nome'];


        require_once "conexao.php";
/*
        $sql = "SELECT * FROM comanda WhERE codigo = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultado_comanda = mysqli_stmt_get_result($stmt);
        $comanda = mysqli_fetch_assoc($resultadoComanda);
        $codigo = $comanda['codigo'];
        $cod_garcom = $comanda['cod_garcom'];
        $cod_mesa = $comanda['cod_mesa'];
        $valortotal = $comanda['valortotal'];
        
        $sql_garcom = "SELECT * FROM funcionario WHERE codigo = ?";
        $stmtGar = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmtGar, "s", $cod_garcom);
        mysqli_stmt_execute($stmtGar);
        $resultado_garcom = mysqli_stmt_get_result($stmtGar);
        $gar = mysqli_fetch_assoc($resultGar);
        $nomeGar = $gar['nome'];

        $sql_mesa = "SELECT * FROM mesa WHERE codigo = ?";
        $stmtMesa = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmtGar, "s", $cod_mesa);
        mysqli_stmt_execute($stmtGar);
        $resultadoMesa = mysqli_stmt_get_result($stmtMesa);
        $mes = mysqli_fetch_assoc($resultMesa);
        $descricao = $mes['descricao'];

*/
        /*
        $sql = "SELECT comanda.codigo, comanda.cod_garcom, comanda.cod_mesa, comanda.valortotal, funcionario.codigo, funcionario.nome FROM comanda INNER JOIN funcionario ON (comanda.cod_garcom = funcionario.codigo )WHERE comanda.codigo = ?";
        */
        $sql = "SELECT * FROM comanda WHERE codigo = ?";

        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $comanda = mysqli_fetch_assoc($resultado);
        $codigo = $comanda['codigo'];
        $cod_garcom = $comanda['cod_garcom'];
        $cod_mesa = $comanda['cod_mesa'];
        $valortotal = $comanda['valortotal'];
        
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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            table { border-collapse: collapse; empty-cells: show; }

            td { position: relative; }

            tr.strikeout td:before {
              content: " ";
              position: absolute;
              top: 50%;
              left: 0;
              border-bottom: 1px solid #FF0000;
              width: 100%;
            }

            tr.strikeout td:after {
              content: "\00B7";
              font-size: 1px;
            }
            
            td { width: 100px; }
            th { text-align: left; }

            .quantidade-prod {
                height: 30px;
            }

            .adicionarProduto{
                height: 35px;
            }
        </style>

    </head>
    <body class="sb-nav-fixed">

         <?php include_once("topo.php");?>

        <div id="layoutSidenav">
            
            <?php include_once("menu.php");?>
            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Comanda</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Comanda</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
								<a href="comanda-lista.php" type="button" class="btn btn-outline-primary">Lista de Comanda</a>
							</div>
                        </div>

                        <div id='mensagem'></div>                                               

                        <div class="card mb-4">
                            <div class="card-header"><i class="fa fa-table mr-1"></i>Nova Comanda</div>
                            <div class="card-body">
                                <form action="" method="POST" id="form-pedido">

                                    <input type="hidden" name="codigo" id="codigo"  class="form-control" value="<?php echo $codigo;?>" />

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
													<div class="form-group">
                                                        <label class="small mb-1" >Mesa </label>
                                                        <select id="mesa" name="mesa" class="form-control select-mesa" >
                                                            <option selected disabled>Selecione...</option>
                                                            <?php 

                                                                while ($dados = mysqli_fetch_array($resultado_mesa)) {

                                                                    if ($cod_mesa == $dados['codigo']) {
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label class="small mb-1" >Garçom </label>
                                                        <select id="garcom" name="garcom" class="form-control select-garcom" >
                                                            <option selected disabled>Selecione...</option>
                                                            <?php 

                                                                while ($dados = mysqli_fetch_array($resultado_garcom)) {

                                                                    if ($cod_garcom == $dados['codigo']) {
                                                                        $selec = 'selected="selected"';
                                                                    }else{
                                                                        $selec = '';
                                                                    }
                                                                    echo '<option value="'.$dados['codigo'].'" '.$selec.'> '.$dados['nome'].'</option>';
                                                                }

                                                             ?>                                                           
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                    <label class="small mb-1" for="tipo">Produto </label>
                                                    <select id="codigoNovoProduto" name="codigoNovoProduto" class="form-control select-produto" >
                                                        <option selected disabled>Selecione...</option>
                                                        <?php 

                                                            while ($dados = mysqli_fetch_array($resultado_produto)) {
                                                                echo '<option value="'.$dados['codigo'].'" > '.$dados['descricaoprod'].'</option>';
                                                            }

                                                         ?>                                                         
                                                    </select>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="form-group">
                                                    <label class="small mb-1">Quantidade</label>
                                                    <input class="form-control quantidade-prod" name="qtdeNovoProduto" id="qtdeNovoProduto" type="number"/>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="form-group">
                                                    <label class="small mb-1"></label>
                                                    <input name="btn-add" class="btn btn-primary adicionarProduto" value="Adicionar">
                                                    <input name="btn-add" class="btn btn-primary confere" value="Conferir cesta">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
										         <table class="table table-bordered tabela-produto" id="tabela-produto" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Descrição</th>
                                                            <th>Quant.</th>
                                                            <th>V. Unit.</th>
                                                            <th>V. total</th>
                                                            <th>ações</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      
                                                    </tbody>
                                                </table>

                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="text-right">
                                                    <strong>TOTAL R$:</strong> 
                                                    <input type="text" id="valortotal" name="valortotal" class="text-danger text-right"
                                                    value="<?php  echo $valortotal;?>" readonly="readonly"/>
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
                <?php include_once("rodape.php");?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script src="js/pedido.js"></script>
        <!-- linha acima para utilizacao do arquivo javascript que esta na pasta js -->
        <script type="text/javascript">
            <?php
                if (isset($_GET['edicao'])) {
                    $sql_pedidocomanda = "SELECT * FROM pedidocomanda WhERE cod_comanda = ".$codigo." ORDER BY codigo";
                    $resultado_pedidocomanda = mysqli_query($conexao, $sql_pedidocomanda);

                    while($dados = mysqli_fetch_array($resultado_pedidocomanda)){
            ?>
                adicionarProduto(<?php  echo $dados['cod_produto']?>,
                                <?php  echo $dados['quantidade']?>,
                                <?php  echo $dados['preco_unitario']?>,
                                <?php  echo $dados['valortotal']?>
                                )
            <?php
                    } //fecha o while
                }  //fecha o if         que bruxaria isso aqui...
            ?>
        </script>
        
       
    </body>
</html>
