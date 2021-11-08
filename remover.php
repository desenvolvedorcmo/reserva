<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "123";
	$dbname = "reserva";
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

$recado_id = $_POST['recado_id'];

$sql = "DELETE FROM `recados` WHERE `recados`.`id` = $recado_id";

if ($conn->query($sql) == TRUE) {
	echo "Removido!";
} else {
      echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
header('Location: http://localhost/reserva/recado-removido.php');

?>