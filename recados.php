<?php
	session_start();
	include_once('conexao.php');
?>

		<?php
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$request = md5(implode($_POST));
				if(isset($_SESSION['ultima_request']) && $_SESSION['ultima_request'] == $request){
					echo "Recado ja foi salvo!";
				}else{
					$_SESSION['ultima_request']  = $request;
					if(isset($_POST['usuario'])){
						$usuario = $_POST['usuario'];
						$email = $_POST['email'];
						$recado = $_POST['recado'];
						$result_recado = "INSERT INTO recados (nome, email, recado, created) VALUES ('$usuario', '$email', '$recado', NOW())";						
						$resultado_recados= mysqli_query($conn, $result_recado);
						//Enviar e-mail
					}
				}
			}	
				
		?>

<!DOCTYPE html>
<html>
<head>
	<title>Mural de Recados</title>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  width: 200px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
  vertical-align: middle;
}

}
</style>



<?php
//"Relacionando tabelas USER e recados"
					$banco = "SELECT * FROM recados";
					$resultado_id = mysqli_query($conn, $banco);
					$rows = mysqli_fetch_assoc($resultado_id);
					   
							?>		

							<?php

						$resultado_id = mysqli_query($conn, "SELECT * FROM users INNER JOIN recados ON(users.user_id=recados.user_id) WHERE users.user_id");
						
			
				?>		



<script>alert("Seu Recado foi Enviado com Sucesso!!!"); </script>

	<center><h2>Recados</h2></center>
<?php	

					$result_recado_bd = "SELECT * FROM recados";
					$resultado_recado_bd = mysqli_query($conn, $result_recado_bd);	


if(mysqli_num_rows($resultado_recado_bd) <= 0 ){
						echo "";
					}else{
						?>
<center><table  id="customers">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Recado</th>
      <th scope="col">Data de envio</th>
    </tr></table></center>
    <?php
   } 
?>
    <?php
     $nm = 1;

		if(mysqli_num_rows($resultado_recado_bd) <= 0 ){
			echo "Nenhum recado...";
		}else{
			while($rows = mysqli_fetch_assoc($resultado_recado_bd)){
				?>	

   <center> <table id="customers">
    <th scope="row"><?php echo $nm ?></th>
      <td><?php echo $rows['nome']; ?></td>
      <td><?php echo $rows['recado']; ?></td>
      <td><?php echo $rows['created'];?></td>
    </table></center>
    <?php $nm++ ; ?>
   
							<?php
						}
					}
				?>			
				<br>
<center><a href="http://localhost/reserva/index.php/"> Voltar ao Inicio! </a></center>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>

</html>

