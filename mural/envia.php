<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "123";
	$dbname = "reserva";
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);



$recado = $_POST['recado'];
$criado = $_POST['criado'];
$usuario_id = $_POST['id_usuario'];

echo $criado;


$sql = "INSERT INTO recados ('recado') VALUES ";
$sql .= "('$recado')"; 
echo $sql;

if ($conn->query($sql) == TRUE) {
	echo "Enviado!";
} 


?>