<?php

	if (!isset($_COOKIE['email'])){
        header("Location:login.php");
    }

    if (!isset($_SESSION)) {
    	session_start();
    }

    $func = $_GET['func'];
    switch ($func) {
    	case 'addprod':
    		addProdCesta();
    		break;

    	case 'remprod':
        
    		removeProdCesta();
    		break;

    	case 'gravapedido':
    		gravapedido();
    		break;

    	case 'deletaPedido':
    		deletaPedido();
    		break;
    	
    	case 'confere':
    		confere();
    		break;

    	default:
    		echo "função não encontrada";
    		break;
    }

    function confere(){
    	print_r($_SESSION["cesta_prod"]);
    }


    function deletaPedido(){

    	require "conexao.php";

    	$codigo = $_GET['codigo'];

    	$sql_produtos = 'DELETE FROM pedidoproduto WHERE cod_pedido = '.$codigo;
    	mysqli_query($conexao, $sql_produtos);

    	$sql_pedido = 'DELETE FROM pedido WHERE codigo = '.$codigo;
    	mysqli_query($conexao, $sql_pedido);

    	echo "1";

    }

    function gravapedido(){


    	require "conexao.php";


        $codigo = mysqli_escape_string($conexao, $_POST['codigo']);
        $garcom = mysqli_escape_string($conexao, $_POST['garcom']);
        $mesa = mysqli_escape_string($conexao, $_POST['mesa']);
    	$valortotal = $_POST['valortotal'];
		$valTot = str_replace(",", ".", $valortotal);

//print_r("eitaaaaaaaLasqueracadastroComanda.php-1");
        if ($codigo > 0) {
            
            $sql = "UPDATE comanda SET cod_garcom=?, cod_mesa=?, valortotal=? WHERE codigo=?";
            $tipos = "iidi";
            $parametros = array($garcom, $mesa, $valTot, $codigo);
        }else{
//print_r("eitaaaaaaaLasqueracadastroComanda.php-2");
            $sql = "INSERT INTO comanda(cod_garcom, cod_mesa, valortotal) VALUES (?,?,?)";
            $tipos = "iid";
            $parametros = array($garcom, $mesa, $valTot);
        }
		$stmt = mysqli_prepare($conexao, $sql);

		mysqli_stmt_bind_param($stmt, $tipos, ...$parametros);

		mysqli_stmt_execute($stmt);
/*
        if(mysqli_stmt_execute($stmt)){
            echo "executou";
        }
        else{
            echo mysqli_stmt_error;
        }
*/
		if (mysqli_stmt_error($stmt)) {
			echo "erro";
		}else{

            if($codigo > 0){   //edicao
                $sql = "DELETE FROM pedidocomanda WHERE codigo = $codigo";
                mysqli_query($conexao, $sql);
                $novo_codigo = $codigo;

            }else{
                $novo_codigo = mysqli_insert_id($conexao);
			}

			if (!empty($_SESSION["cesta_prod"])) {

					$query = '';
					foreach ($_SESSION["cesta_prod"] as $key => $value) {
						$query .= 'INSERT INTO pedidocomanda(cod_comanda, cod_produto, quantidade, preco_unitario, valortotal) VALUES ('.$novo_codigo.','.$value['codigo'].','.$value['quantidade'].','.$value['preco_unitario'].','.$value['valortotal'].' ); ';
					}
					mysqli_multi_query($conexao, $query);
				}	
		}
		mysqli_stmt_close($stmt);
    }


    function removeProdCesta(){
    	$cod_cesta = $_GET['cod_cesta'];
print_r($cod_cesta);
    	if (!empty($_SESSION["cesta_prod"])) {
    		foreach($_SESSION["cesta_prod"] as $key => $value){
    			if ($value['cod_cesta'] == $cod_cesta) {
    				unset($_SESSION["cesta_prod"][$key]);
    			}
    		}
    	}
    }

    function addProdCesta(){

    	$codigo = $_GET['id'];
    	$quantidade = $_GET['quantidade'];
        $preco_unitario = $_GET['valorunit'];
        $valortotal = $_GET['valortotal'];

    	if (isset($codigo)) {
    		
    		require "conexao.php";
    		$sql_prod = "SELECT * FROM produto WHERE codigo = '$codigo'";
    		$resultado = mysqli_query($conexao, $sql_prod);
    		$array = mysqli_fetch_array($resultado);

    		$id = $array['codigo'];
    		$descricao = $array['descricaoprod'];

            if (!isset($preco_unitario) || $preco_unitario == 0) {
                $preco_unitario = $array['precounit'];
            }

    		if (!isset($valortotal) || $valortotal ==0) {
    		    $valortotal = $quantidade * $preco_unitario;
            }

    		if(!isset($_SESSION["cesta_prod"])){
	    		$cod_cesta = 1;
	    	}else{
	    		$cod_cesta=count($_SESSION["cesta_prod"])+1;
	    	}

    		$retorno_array[] = array(
    			"cod_cesta" => $cod_cesta,
    			"codigo" => $id,
    			"descricao" => $descricao,
    			"quantidade" => $quantidade,
    			"preco_unitario" => $preco_unitario,
    			"valortotal" => $valortotal);

    		if (!empty($_SESSION["cesta_prod"])) {
    			$_SESSION["cesta_prod"] = array_merge($_SESSION["cesta_prod"], $retorno_array);
    		}else{
    			$_SESSION["cesta_prod"] = $retorno_array;	
    		}
    		

    		echo json_encode($retorno_array);

    	}
    }


?>