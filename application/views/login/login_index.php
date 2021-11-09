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
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
}


#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;

}


#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  background-color: #04AA6D;
  color: white;
  text-align: center;

}

#customers tr td{
    white-space: pre-wrap;
}





</style>
	<left><h2>Recados</h2></left>
<?php	

					$result_recado_bd = "SELECT * FROM recados";
					$resultado_recado_bd = mysqli_query($conn, $result_recado_bd);	


if(mysqli_num_rows($resultado_recado_bd) <= 0 ){
						echo "";
					}else{
						?>
<div class="card-block">
   <div class="dt-responsive table-responsive">

<table class="table table-striped table-bordered" id="customers">
    <tr>
      <th width="10" scope="col">#</th>
      <th width="100" scope="col">Nome</th>
      <th height="12" width="400" scope="col">Recado</th>
      <th width="30" scope="col">Data de envio</th>
    </tr></table>
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

    <table id="customers">
    <th width="10" scope="row"><?php echo $nm ?></th>
      <td width="100"><?php echo $rows['nome']; ?></td>
      <td width="400"><?php echo $rows['recado']; ?></td>
      <td width="30"><?php echo $rows['created'];?></td>
    </table>
    <?php $nm++ ; ?>
   
							<?php
						}
					}
				?>			



</head>

   