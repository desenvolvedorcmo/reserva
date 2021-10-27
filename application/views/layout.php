<?php

if ($this->userauth->logged_in()) {
	$menu[1]['text'] = img('assets/images/ui/link_controlpanel.png', FALSE, 'hspace="4" align="top" alt=" "') . 'Painel de controle';
	$menu[1]['href'] = site_url('/');
	$menu[1]['title'] = 'Painel de controle';

	if($this->userauth->is_level(ADMINISTRATOR)){ $icon = 'user_administrator.png'; } else { $icon = 'user_teacher.png'; }
	$menu[3]['text'] = img('assets/images/ui/logout.png', FALSE, 'hspace="4" align="top" alt=" "') . 'Sair';
	$menu[3]['href'] = site_url('logout');
	$menu[3]['title'] = 'Sair';
}
?>

<!DOCTYPE html>
<html>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Craig A Rodway">
	<title><?= html_escape($title) ?> | Reservas CMO</title>
	<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('assets/style.css') ?>">
	<link rel="stylesheet" type="text/css" media="print" href="<?= base_url('assets/print.css') ?>">
	<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('assets/sorttable.css') ?>">
	<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('assets/datepicker.css') ?>">
	<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('assets/unpoly.min.css') ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/brand/apple-touch-icon.png') ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/brand/favicon-32x32.png') ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/brand/favicon-16x16.png') ?>">
	<link rel="manifest" href="<?= base_url('assets/brand/site.webmanifest') ?>">
	<link rel="mask-icon" href="<?= base_url('assets/brand/safari-pinned-tab.svg') ?>" color="#ff6400">
	<link rel="shortcut icon" href="<?= base_url('assets/brand/favicon.ico') ?>">

	<meta name="msapplication-TileColor" content="#ff6400">
	<meta name="msapplication-config" content="<?= base_url('assets/brand/browserconfig.xml') ?>">
	<meta name="theme-color" content="#ff6400">

	<script>
	var h = document.getElementsByTagName("html")[0];
	(h ? h.classList.add('js') : h.className += ' ' + 'js');
	var BASE_URL = "<?= base_url() ?>";
	</script>
</head>
<body>

	<?php
	if (setting('maintenance_mode') == 1) {
		$message = setting('maintenance_mode_message');
		if ( ! strlen($message)) {
			$message = 'Estamos atualmente em modo de manutenção. Verifique novamente em breve.';
		}
		echo "<div class='maintenance-wrapper'>";
		echo "<div class='outer'>";
		echo html_escape($message);
		echo "</div>";
		echo "</div>";
	}
	?>
	<div class="outer">

		<div class="header">

			<div class="nav-box">
				<?php if( ! $this->userauth->logged_in()) { echo '<br /><br />'; } ?>
				<?php
				$i=0;
				if(isset($menu)){
					foreach( $menu as $link ){
						echo "\n".'<a href="'.$link['href'].'" title="'.$link['title'].'">'.$link['text'].'</a>'."\n";
						if( $i < count($menu)-1 ){ echo img('assets/images/blank.png', FALSE, 'width="16" height="16"'); }
						$i++;
					}
				}
				?><br />
				<?php
				if ($this->userauth->logged_in()) {
					$output = html_escape(strlen($this->userauth->user->cdisplayname) > 1 ? $this->userauth->user->displayname : $this->userauth->user->username);
					echo "<p class='normal'>Logado como {$output}</p>";
				}
				?>
			</div>

			<br />

			<span class="title">
				<?php
				$name = '';
				if (config_item('is_installed')) {
					$name = setting('name');
				}
				if (strlen($name)) {
					echo anchor('/', html_escape($name));
				} else {
					$attrs = "title='classroombookings' style='font-weight:normal;color:#0081C2;letter-spacing:-2px'";
					$output = "classroom";
					$output .= "<span style='color:#ff6400;font-weight:bold'>bookings</span>";
					echo anchor('/', $output, $attrs);
				}
				?>
			</span>

		</div>

		<?php if (isset($midsection)): ?>
			<div class="mid-section" align="center">
				<h1 style="font-weight:normal"><?php echo $midsection ?></h1>
			</div>
		<?php endif; ?>

		<div class="content_area">
			<?php if(isset($showtitle)){ echo '<h2>'.html_escape($showtitle).'</h2>'; } ?>
			<?php echo $body ?>
		</div>

	</div>

	<div id="tipDiv" style="position:absolute; visibility:hidden; z-index:100"></div>

	<?php
	foreach ($scripts as $script)
	{
		echo "<script type='text/javascript' src='{$script}'></script>\n";
	}
	?>

</body>
</html>

<?php // inicio Mural
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
	<center><body>
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

				<div class="container theme-showcase" role="main">
			<div class="page-header">

				<h2>Mural de Recados</h2>

<form method="post" action="http://localhost/reserva/envia.php/">
			<div class="form-group">
						<h6>Deixe seu Recado: </h6>
						
						<input type="hidden" name="nome" value=<?php echo $output;?> >
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

  <table  margin="10">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Recado</th>
      <th scope="col">Data de envio</th>
    </tr>
  </table>
				<?php
					$result_recado_bd = "SELECT * FROM recados";
					$resultado_recado_bd = mysqli_query($conn, $result_recado_bd);
    				 $nm = 1;
					if(mysqli_num_rows($resultado_recado_bd) <= 0 ){
						echo "Nenhum recado...";
					}else{
						while($rows = mysqli_fetch_assoc($resultado_recado_bd)){
	
						?>	

 
    <table  margin="10">
      <th scope="row"><?php echo $nm ?></th>
      <td><?php echo $rows['nome']; ?></td>
      <td><?php echo $rows['recado']; ?></td>
      <td><?php echo $rows['created'];?></td>
    </table>
    <?php $nm++ ; ?>
   
							<?php
						}
					}
				?>				
			</div>
		</div>
	</body>
</center>
</html>

<?php //Rodapé ?>
<div class="footer">
			<br />

			<div id="footer">
				<?php
				if (isset($menu)) {
					foreach( $menu as $link ) {
						echo "\n".'<a href="'.$link['href'].'" title="'.$link['title'].'">'.$link['text'].'</a>'."\n";
						echo img('assets/images/blank.png', FALSE, 'width="16" height="10" alt=" "');
					}
				}
				?>
				<br /><br />
				<span style="font-size:90%;color:#678; line-height: 2">
					<!--  <a href="https://www.classroombookings.com/" target="_blank">classroombookings</a> version <?= VERSION ?>.-->
					&copy; <?= date('Y') ?> Câmara Municipal de Ourinhos.
					<br />
					Tempo de carregamento: <?php echo $this->benchmark->elapsed_time() ?> segundos.
				</span>
				<br /><br />
			</div>
			


			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		</div>