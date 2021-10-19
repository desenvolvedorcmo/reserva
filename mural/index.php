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
									 <h class="media-heading"> Você está conectado como: </h> <strong> <?php echo $rows ['nome']; ?> </strong>
								</div>
							</div>	

<?php // 15/10 Note: Postar recado com o usuario logado e printar o NOME do usuario  ?>
				<h1>Mural de Recados</h1>


<form method="post" action="envia.php">
			<div class="form-group">
						<label for="eaedanilo1@gmail.com">Deixe seu Recado: </label>
						
						<input type="hidden" name="nome" value=<?php echo $rows ['nome'];?> >
						<input type="hidden" name="email" value=<?php echo $rows ['email'];?> >
						<textarea <input type="text" name="recado" class="form-control" rows="3"></textarea>
					 
					 <?php //pegando horario
					setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
					date_default_timezone_set('America/Sao_Paulo');
					$created = date("Y-m-d H:i:s"); 
					?>

						<input type="hidden" name="created" value=<?php echo $created;?>> 
						<input type="hidden" name="id_usuario" value=<?php echo $rows ['user_id'];?>>
						
					</div>
					<input type="submit" class="btn btn-danger" value="Enviar">
				</form>




				
				<h2>Recados</h2>
				<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Recado</th>
      <th scope="col">Data de envio</th>
    </tr>
  </thead>
				<?php
					$result_recado_bd = "SELECT * FROM recados";
					$resultado_recado_bd = mysqli_query($conn, $result_recado_bd);
    				 $nm = 1;
					if(mysqli_num_rows($resultado_recado_bd) <= 0 ){
						echo "Nenhum recado...";
					}else{
						while($rows = mysqli_fetch_assoc($resultado_recado_bd)){
	
						?>	

  <tbody>
    <tr>
      <th scope="row"><?php echo $nm ?></th>
      <td><?php echo $rows['nome']; ?></td>
      <td><?php echo $rows['recado']; ?></td>
      <td><?php echo $rows['created'];?></td>
    </tr>
    <?php $nm++ ; ?>
   


							
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