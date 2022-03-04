<?php
	
	//include
	//require
	//require_once 
	require_once "conexao.php";

	if (isset($_POST['btn-cadastrar'])) {

		$codigo = mysqli_escape_string($conexao, $_POST['codigo']);
		$nome = mysqli_escape_string($conexao, $_POST['nome']);



		if ($codigo > 0) { //edicao
			$sql = "UPDATE funcionario SET nome=? WHERE codigo=?";
			$tipos = "si";
			$parametros=  array($nome, $codigo);
		}else{ // inclusao
			$sql = "INSERT INTO funcionario(nome) VALUES(?)";
			$tipos = "s";
			$parametros=  array($nome);
		}
		$stmt = mysqli_prepare($conexao,$sql);

		if(!$stmt){
			echo "Erro no cadastro do funcionario: ".mysqli_error($conexao);
		}
			// s=string  -  d=double     i=inteiro      
		mysqli_stmt_bind_param($stmt, $tipos, ...$parametros);

		mysqli_stmt_execute($stmt);

		if (mysqli_stmt_error($stmt)) {
			//echo "Erro ao cadastrar cliente";
			header('location: funcionario-novo.php?erro');
		}else{
			if ($codigo > 0) {
				//echo "Cliente atualizado com sucesso!";
				header('location: funcionario-novo.php?atual');
			}else{
				//echo "Cliente cadastrado com sucesso!";
				header('location: funcionario-novo.php?sucesso');
			}
		}
		mysqli_stmt_close($stmt);
	}

/*
	//inclusao e alteração
	if (isset($_POST['btn-cadastrar'])) {

		$codigo = mysqli_escape_string($conexao, $_POST['codigo']);
		$nome = mysqli_escape_string($conexao, $_POST['nome']); 

		//trim remove espacos

		$sql_func = "SELECT nome FROM funcionario WHERE nome = '$nome'";
		$resultado = mysqli_query($conexao, $sql_func);
		$array = mysqli_fetch_array($resultado);


		$sql = "INSERT INTO usuario(nome) values(?)";
		$tipos = "ss";
		$parametros=  array($nome);

		$stmt = mysqli_prepare($conexao,$sql);

		if(!$stmt){
			echo "Erro no cadastro de funcionario: ".mysqli_error($conexao);
		}
			// s=string  -  d=double     i=inteiro      
		mysqli_stmt_bind_param($stmt, $tipos, ...$parametros);

		mysqli_stmt_execute($stmt);

		if (mysqli_stmt_error($stmt)) {
			//echo "Erro ao cadastrar cliente";
			header('location: usuario-novo.php?erro');
		}else{
			if ($codigo > 0) {
				//echo "Cliente atualizado com sucesso!";
				header('location: funcionario-novo.php?atual');
			}else{
				//echo "Cliente cadastrado com sucesso!";
				header('location: funcionario-novo.php?sucesso');
			}
		}
		mysqli_stmt_close($stmt);
	
	}
*/



	//exclusao
	if(isset($_POST['deleta'])){

		$codigo = mysqli_escape_string($conexao, $_POST['codigo']);

		$sql = "DELETE FROM funcionario WHERE codigo = ?";

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