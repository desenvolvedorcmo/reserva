<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "123";
	$dbname = "reserva";
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

$nome = $_POST['nome'];
$email = $_POST['email'];
$recado = $_POST['recado'];
$created = $_POST['created'];

$sql = "INSERT INTO recados (nome, email, recado, created) VALUES ";
$sql .= "('$nome', '$email', '$recado', now())"; 

if ($conn->query($sql) == TRUE) {
	echo "Enviado!";
} else {
      echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
header('Location: http://localhost/reserva/recados.php');


?>