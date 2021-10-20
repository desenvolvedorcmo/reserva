<?php
	session_start();
	include_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<title>Mural de Recados</title>
	</head>
	<body>
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
		<div class="container theme-showcase" role="main">
			<div class="page-header">

<?php $output = html_escape(strlen($this->userauth->user->cdisplayname) > 1 ? $this->userauth->user->displayname : $this->userauth->user->username);

echo $output . "ola" .
 ?>
<?php
//"Relacionando tabelas USER e recados"
					$banco = "SELECT * FROM recados";
					$resultado_id = mysqli_query($conn, $banco);
					$rows = mysqli_fetch_assoc($resultado_id);
					   
							?>		

							<?php

						$resultado_id = mysqli_query($conn, "SELECT * FROM users INNER JOIN recados ON(users.user_id=recados.user_id) WHERE users.user_id");
						$rowUser = mysqli_fetch_array($resultado_id);
			
				?>			
<?php //Printando nome do usuario  ?>
				<div class="media">
								<div class="media-body">
									 <h class="media-heading"> Você está conectado como: </h> <strong> <?php echo $rows ['name']; ?> </strong>
								</div>
							</div>	


				<h1>Mural de Recados</h1>


<form method="post" action="envia.php">
			<div class="form-group">
						<label for="eaedanilo1@gmail.com">Deixe seu Recado: </label>
						
						<input type="hidden" name="nome" value=<?php echo $rows ['firstname'];?> >
						<input type="hidden" name="email" value=<?php echo $rows ['email'];?> >
						<textarea <input type="text" name="recado" class="form-control" rows="3"></textarea>
					 
					 <?php //pegando horario
					$created = date("Y-m-d H:i:s");
					 ?>

						<input type="hidden" name="created" value=<?php echo $created;?> >
						<input type="hidden" name="id_usuario" value=<?php echo $rows ['user_id'];?> >
						
					</div>
					<input type="submit" class="btn btn-danger" value="Enviar">
				</form>




				
				<h2>Recados</h2>
				<?php
					$result_recado_bd = "SELECT * FROM recados";
					$resultado_recado_bd = mysqli_query($conn, $result_recado_bd);
					if(mysqli_num_rows($resultado_recado_bd) <= 0 ){
						echo "Nenhum recado...";
					}else{
						while($rows = mysqli_fetch_assoc($resultado_recado_bd)){
							?>							
							<div class="media">
								<div class="media-body">
									<h4 class="media-heading"><?php echo $rows['nome']; ?></h4>
									<?php echo $rows['recado']; ?>
								</div>
							</div>
							<?php
						}
					}
				?>				
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>