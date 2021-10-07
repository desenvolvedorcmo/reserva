<?php
echo $this->session->flashdata('saved');
echo isset($notice) ? $notice : '';
echo form_open_multipart(current_url(), array('class' => 'cssform', 'id' => 'user_import'));
echo form_hidden('action', 'import');
?>

<fieldset class="cssform-stacked">

	<legend accesskey="I" tabindex="<?= tab_index() ?>">Fonte de dados</legend>

	<p class="input-group">
		<label for="userfile" class="required">Arquivo CSV</label>
		<?php
		echo form_upload(array(
			'name' => 'userfile',
			'id' => 'userfile',
			'size' => '40',
			'maxlength' => '255',
			'tabindex' => tab_index(),
			'value' => '',
		));
		?>
		<p class="hint">Tamanho m&aacute;ximo do arquivo <span><?php echo $max_size_human ?></span>.</p>
	</p>


</fieldset>



<fieldset>

	<legend accesskey="F">Valores padr&atilde;o</legend>

	<div>Insira os valores padrão que serão aplicados a todos os usuários caso não forem especificados no arquivo de importação.</div>

	<p class="input-group">
		<label for="password">Senha</label>
		<?php
		echo form_password(array(
			'name' => 'password',
			'id' => 'password',
			'size' => '20',
			'maxlength' => '40',
			'tabindex' => tab_index(),
			'value' => '',
		));
		?>
	</p>

	<p class="input-group">
		<label for="authlevel" class="required">Tipo</label>
		<?php
		$data = array('1' => 'Administrador', '2' => 'Funcionário');
		echo form_dropdown(
			'authlevel',
			$data,
			'2',
			' id="authlevel" tabindex="'.tab_index().'"'
		);
		?>
	</p>


	<p class="input-group">
		<label for="enabled">Habilitado</label>
		<?php
		echo form_hidden('enabled', '0');
		echo form_checkbox(array(
			'name' => 'enabled',
			'id' => 'enabled',
			'value' => '1',
			'tabindex' => tab_index(),
			'checked' => true,
		));
		?>
	</p>


</fieldset>

<?php

$this->load->view('partials/submit', array(
	'submit' => array('Criar Usuários', tab_index()),
	'cancel' => array('Cancelar', tab_index(), 'users'),
));

echo form_close();
