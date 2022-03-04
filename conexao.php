<?php

	//$servidor = "localhost";
	$servidor = '127.0.0.1';
	$usuario = "root";
	$senha = "root";
	$nome_banco = "JoaoNetoFinal";
	//mysqli_set_charset($conexao,"utf8");
	//conexao com mysql no tipo estruturado
	$conexao = mysqli_connect($servidor,$usuario,$senha,$nome_banco);// or die ("nao conectado a mysql");

/*
	$conexao = mysqli_connect ($servidor, $usuario, $senha) or die('Not connected : Ah sh*t ' . mysqli_connect_error());
*/
	if (mysqli_connect_error()) {
		echo "<br><br>Erro de conexão: ".mysqli_connect_error();
	}
	
?>