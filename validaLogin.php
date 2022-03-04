<?php

	//include
	//require
	//require_once 
	require_once "conexao.php";

	//inclusao e alteração
	if (isset($_POST['btn-entrar'])) {

		//$login = $_POST['email'];
		$email = mysqli_escape_string($conexao, $_POST['email']); 
		$senha = md5($_POST['senha']); 

		$sql_login = "SELECT email FROM usuario WHERE email = '$email' AND senha='$senha'";
		$resultado = mysqli_query($conexao, $sql_login);
		$row = mysqli_num_rows($resultado);
		//$array = mysqli_fetch_array($resultado);

		if($row <= 0 ){
			//header('location: login.php?existe');  //outro modo em java script
			echo "<script language='javascript' type='text/javascript'>
				alert('Login e/ou senha incorretos.');
				window.location.href='login.php';
				</script>
			";
			die(); //forca o "window.location.href='login.php';" a entrar no endereço. evita erros
		}else{
			//armazena no kookie o login do usuario. para cada pagina fazer uma verificacao de kookie
			//exemplo no inicio da pagina "usuario-lista.php" e "usuario-novo.php"
			setcookie("email", $email);
			header("Location:index.php");

		}


	}


	if (isset($_POST['btn-cadastrar'])) {
		
		$email = mysqli_escape_string($conexao, $_POST['email']); 
		$senha = mysqli_escape_string($conexao, $_POST['senha']); 
		$confirmasenha = mysqli_escape_string($conexao, $_POST['confirmasenha']);

		if ($senha != $confirmasenha) {
			header('location: cadUsuario.php.php?senhadif');
		}

		$senhaCrip = md5($senha);

		$sql = "INSERT INTO usuario(email, senha) VALUES(?,?)";
		$tipos = "ss";
		$parametros=  array($email, $senhaCrip);

		$stmt = mysqli_prepare($conexao,$sql);

		if(!$stmt){
			echo "Erro no cadastro de usuario: ".mysqli_error($conexao);
		}


		mysqli_stmt_bind_param($stmt, $tipos, ...$parametros);

		mysqli_stmt_execute($stmt);

		if (mysqli_stmt_error($stmt)) {
			//echo "Erro ao cadastrar cliente";
			header('location: cadUsuario.php?senhadif');
		}else{
			/*
			$codigo = 0;
			if ($codigo > 0) {
				echo "Cliente atualizado com sucesso!";
				//header('location: produto-novo.php?atual');
			}else{
				echo "Cliente cadastrado com sucesso!";
				//header('location: cadUsuario.php?sucesso');

			}
			*/
			header('location: login.php');
		}
		mysqli_stmt_close($stmt);

	}

	if (isset($_POST['btn-salvar'])) {
		
		$email = mysqli_escape_string($conexao, $_POST['email']); 
		$senha = mysqli_escape_string($conexao, $_POST['senha']); 
		$confirmasenha = mysqli_escape_string($conexao, $_POST['confirmasenha']);

		if ($senha != $confirmasenha) {
			header('location: cadUsuario.php.php?senhadif');
		}

		$senhaCrip = md5($senha);

		$sql = "INSERT INTO usuario(email, senha) VALUES(?,?)";
		$tipos = "ss";
		$parametros=  array($email, $senhaCrip);

		$stmt = mysqli_prepare($conexao,$sql);

		if(!$stmt){
			echo "Erro no cadastro de usuario: ".mysqli_error($conexao);
		}


		mysqli_stmt_bind_param($stmt, $tipos, ...$parametros);

		mysqli_stmt_execute($stmt);

		if (mysqli_stmt_error($stmt)) {
			//echo "Erro ao cadastrar cliente";
			header('location: cadUsuario.php?senhadif');
		}else{
			
			//$codigo = 0;
			if ($codigo > 0) {
				//echo "Cliente atualizado com sucesso!";
				header('location: usuario-novo.php?atual');
			}else{
				//echo "Cliente cadastrado com sucesso!";
				header('location: usuario-novo.php?sucesso');

			}
			
			header('location: login.php');
		}
		mysqli_stmt_close($stmt);

	}

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