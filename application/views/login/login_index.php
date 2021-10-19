<h2>Entrar</h2>

<?php
if (strlen($message)) {
	echo "<div>" . nl2br($message) . "</div><br><br>";
}

echo $this->session->flashdata('auth');

echo validation_errors();

echo form_open('login/submit', array('id'=>'login','class'=>'cssform'), array('page' => $this->uri->uri_string()) );

?>


<fieldset style="width:336px;"><legend accesskey="L" tabindex="<?php echo tab_index() ?>">Entrar</legend>

	<p>
	  <label for="username" class="required">Usuário</label>
	  <?php
		$value = set_value('username', '', FALSE);
		echo form_input(array(
			'name' => 'username',
			'id' => 'username',
			'size' => '20',
			'maxlength' => '20',
			'tabindex' => tab_index(),
			'value' => $value,
		));
		?>
	</p>


	<p>
	  <label for="password" class="required">Senha</label>
	  <?php
		echo form_password(array(
			'name' => 'password',
			'id' => 'password',
			'size' => '20',
			'tabindex' => tab_index(),
			'maxlength' => '20',
		));
		?>
	</p>

</fieldset>

<?php

$this->load->view('partials/submit', array(
	'submit' => array('Entrar', tab_index()),
));

echo form_close();
?>

<?php // RECADOS
	$servidor = "localhost";
	$usuario = "root";
	$senha = "123";
	$dbname = "reserva";
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
	?>		

<!DOCTYPE html>
<html>
<head>
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
</head>
<body>



</body>
</html>
