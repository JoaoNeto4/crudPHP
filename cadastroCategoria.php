<?php
	
	if (!isset($_COOKIE['email'])) {
      		header("Location:login.php");
    	}

	//include
	//require
	//require_once 
	require_once "conexao.php";

	//inclusao e alteração
	if (isset($_POST['btn-cadastrar'])) {

		$codigo = mysqli_escape_string($conexao, $_POST['codigo']);
		//$_POST['descricao'];
		//    ou
		$descricao = mysqli_escape_string($conexao, $_POST['descricao']); 
		
		//echo "descricao: ".$descricao;

		if ($codigo > 0) { //edicao
			$sql = "UPDATE categoriaproduto SET descricao=? WHERE codigo=?";
			$tipos = "si";
			$parametros=  array($descricao, $codigo);
		}else{ // inclusao
			$sql = "INSERT INTO categoriaproduto(descricao) VALUES(?)";
			$tipos = "s";
			$parametros=  array($descricao);
		}
		$stmt = mysqli_prepare($conexao,$sql);

		if(!$stmt){
			echo "Erro no cadastro de categoria: ".mysqli_error($conexao);
		}
			// s=string  -  d=double     i=inteiro      
		mysqli_stmt_bind_param($stmt, $tipos, ...$parametros);

		mysqli_stmt_execute($stmt);

		if (mysqli_stmt_error($stmt)) {
			//echo "Erro ao cadastrar categoria";
			header('location: categoria-novo.php?erro');
		}else{
			if ($codigo > 0) {
				//echo "categoria atualizado com sucesso!";
				header('location: categoria-novo.php?atual');
			}else{
				//echo "categoria cadastrado com sucesso!";
				header('location: categoria-novo.php?sucesso');
			}
		}
		mysqli_stmt_close($stmt);
	}

	//exclusao
	if(isset($_POST['deleta'])){

		$codigo = mysqli_escape_string($conexao, $_POST['codigo']);

		$sql = "DELETE FROM categoriaproduto WHERE codigo = ?";

		$stmt = mysqli_prepare($conexao, $sql);

		mysqli_stmt_bind_param($stmt, "i", $codigo);

		mysqli_stmt_execute($stmt);

		$erro= mysqli_stmt_error($stmt);

		mysqli_stmt_close($stmt);

		if ($erro) {
			echo 0;
		}else{
			echo 1;;
		}
	}

?>
