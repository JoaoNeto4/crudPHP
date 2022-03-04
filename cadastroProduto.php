<?php
	
	//include
	//require
	//require_once 
	require_once "conexao.php";

	//inclusao e alteração
	if (isset($_POST['btn-cadastrar'])) {

		$codigo = mysqli_escape_string($conexao, $_POST['codigo']);
		$categoria = mysqli_escape_string($conexao, $_POST['categoria']);
		$descricaoprod = mysqli_escape_string($conexao, $_POST['descricaoprod']); 
		//$precounitSTR = mysqli_escape_string($conexao, $_POST['precounit']); 
		$precounitSTR = $_POST['precounit']; 
		$precounit=str_replace(",", ".", $precounitSTR);
		

		//$valortotal = $_POST['valortotal'];
		//$valortotal = str_replace(",", ".", $valortotal);


		if ($codigo > 0) { //edicao
			$sql = "UPDATE produto SET categoria=?, descricaoprod=?, precounit=? WHERE codigo=?";
			$tipos = "isdi";
			$parametros=  array($categoria, $descricaoprod, $precounit, $codigo);
		}else{ // inclusao
			$sql = "INSERT INTO produto(categoria, descricaoprod, precounit) values(?,?,?)";
			$tipos = "isd";
			$parametros=  array($categoria, $descricaoprod, $precounit);
		}
		$stmt = mysqli_prepare($conexao,$sql);

		if(!$stmt){
			echo "Erro no cadastro do produto: ".mysqli_error($conexao);
		}
			// s=string  -  d=double     i=inteiro      
		mysqli_stmt_bind_param($stmt, $tipos, ...$parametros);

		mysqli_stmt_execute($stmt);

		if (mysqli_stmt_error($stmt)) {
			//echo "Erro ao cadastrar cliente";
			header('location: produto-novo.php?erro');
		}else{
			if ($codigo > 0) {
				//echo "Cliente atualizado com sucesso!";
				header('location: produto-novo.php?atual');
			}else{
				//echo "Cliente cadastrado com sucesso!";
				header('location: produto-novo.php?sucesso');
			}
		}
		mysqli_stmt_close($stmt);
	}

	//exclusao
	if(isset($_POST['deleta'])){

		$codigo = mysqli_escape_string($conexao, $_POST['codigo']);

		$sql = "DELETE FROM produto WHERE codigo = ?";

		$stmt = mysqli_prepare($conexao, $sql);

		mysqli_stmt_bind_param($stmt, "i", $codigo);

		mysqli_stmt_execute($stmt);

		$erro= mysqli_stmt_error($stmt);

		mysqli_stmt_close($stmt);

		if ($erro) {
			echo 0;
		}else{
			echo 1;
		}
	}

?>