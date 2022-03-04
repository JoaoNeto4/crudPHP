<?php
	
	//include
	//require
	//require_once 
	require_once "conexao.php";

	if (!isset($_COOKIE['email'])) {
        header("Location:login.php");
    }

	//inclusao e alteração
	if (isset($_POST['btn-cadastrar'])) {

		$codigo = mysqli_escape_string($conexao, $_POST['codigo']);
		//$_POST['nome'];
		//    ou
		$login = mysqli_escape_string($conexao, $_POST['email']); 
		$senha = trim(mysqli_escape_string($conexao, $_POST['senha'])); 
		$conf_senha = trim(mysqli_escape_string($conexao, $_POST['conf_senha'])); 
		//trim remove espacos
		
		if ($senha != $conf_senha) {
			header('location: usuario-novo.php?senhadif');
		}

		$senha = md5($senha);

		$sql_login = "SELECT email FROM usuario WHERE email = '$login'";
		$resultado = mysqli_query($conexao, $sql_login);
		$array = mysqli_fetch_array($resultado);

		if($login == $array['email']){
			header('location: usuario-novo.php?existe');
		}else{
			$sql = "INSERT INTO usuario(email, senha) values(?,?)";
			$tipos = "ss";
			$parametros=  array($login, $senha);

			$stmt = mysqli_prepare($conexao,$sql);

			if(!$stmt){
				echo "Erro no cadastro de usuario: ".mysqli_error($conexao);
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
					header('location: usuario-novo.php?atual');
				}else{
					//echo "Cliente cadastrado com sucesso!";
					header('location: usuario-novo.php?sucesso');
				}
			}
			mysqli_stmt_close($stmt);


		}
	}




	//exclusao
	if(isset($_POST['deleta'])){

		$codigo = mysqli_escape_string($conexao, $_POST['codigo']);

		$sql = "DELETE FROM usuario WHERE codigo = ?";

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