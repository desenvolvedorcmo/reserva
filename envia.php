<?php include("conexao.php"); 

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