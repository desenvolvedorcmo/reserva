<?php
echo $this->session->flashdata('saved');
echo form_open(current_url(), array('id'=>'settings', 'class'=>'cssform'));
?>


<fieldset>

	<legend accesskey="S" tabindex="<?php echo tab_index() ?>">Reservas</legend>

	<p>
		<label for="bia">Reserva com antecedência</label>
		<?php
		$value = (int) set_value('bia', element('bia', $settings), FALSE);
		echo form_input(array(
			'name' => 'bia',
			'id' => 'bia',
			'size' => '5',
			'maxlength' => '3',
			'tabindex' => tab_index(),
			'value' => $value,
		));
		?>
		<p class="hint">Quantos dias no futuro os usuários podem fazer suas próprias reservas. Coloque <span>0</span> para nenhuma restrição.</p>
	</p>
	<?php echo form_error('bia') ?>

	<p>
		<label for="num_max_bookings">Máximo de reservas ativas</label>
		<?php
		$value = (int) set_value('num_max_bookings', element('num_max_bookings', $settings), FALSE);
		echo form_input(array(
			'name' => 'num_max_bookings',
			'id' => 'num_max_bookings',
			'size' => '5',
			'tabindex' => tab_index(),
			'value' => $value,
		));
		?>
		<p class="hint">Número máximo de reservas únicas ativas para um usuário. Coloque <span>0</span> para nenhuma restrição.</p>
		<p class="hint">'Ativo' é qualquer reserva única para uma data e hora de início de período no futuro.</p>
	</p>
	<?php echo form_error('num_max_bookings') ?>

	<hr size="1" />

	<p id="settings_displaytype">
		<label for="displaytype">Tipo de Exibição</label>
		<?php

		$field = "displaytype";
		$value = set_value($field, element($field, $settings), FALSE);

		$options = [
			['value' => 'day', 'label' => 'Um Dia de cada vez', 'enable' => 'd_columns_rooms'],
			['value' => 'room', 'label' => 'Um Item de cada vez', 'enable' => 'd_columns_days'],
		];

		foreach ($options as $opt) {
			$id = "{$field}_{$opt['value']}";
			$input = form_radio(array(
				'name' => $field,
				'id' => $id,
				'value' => $opt['value'],
				'checked' => ($value == $opt['value']),
				'tabindex' => tab_index(),
				'up-switch' => '.d_columns_target',
			));
			echo "<label for='{$id}' class='ni'>{$input}{$opt['label']}</label>";
		}

		?>
		<br />
		<p class="hint">Especifique o foco principal da página de reservas.<br />
			<strong><span>Um Dia de cada vez</span></strong> - todos os períodos e quartos são mostrados para a data selecionada.<br />
			<strong><span>Um Item de cada vez</span></strong> - todos os períodos e dias da semana são mostrados para o quarto selecionado.
		</p>
	</p>
	<?php echo form_error('displaytype'); ?>

	<p id="settings_columns">
		<label for="columns">Colunas</label>
		<?php

		$field = 'd_columns';
		$value = set_value($field, element($field, $settings), FALSE);

		$options = [
			['value' => 'periods', 'label' => 'Períodos', 'for' => ''],
			['value' => 'rooms', 'label' => 'Itens', 'for' => 'day'],
			['value' => 'days', 'label' => 'Dias', 'for' => 'room'],
		];

		foreach ($options as $opt) {
			$id = "{$field}_{$opt['value']}";
			$input = form_radio(array(
				'name' => $field,
				'id' => $id,
				'value' => $opt['value'],
				'checked' => ($value == $opt['value']),
				'tabindex' => tab_index(),
			));
			echo "<label for='{$id}' class='d_columns_target ni' up-show-for='{$opt['for']}'>{$input}{$opt['label']}</label>";
		}
		?>
		<p class="hint">Selecione quais detalhes você deseja exibir na parte superior da página de reservas.</p>
	</p>
	<?php echo form_error('d_columns') ?>

	<hr size="1" />

	<p>
		<label for="<?= $field ?>">Detalhes do usuario</label>
		<?php

		$field = 'bookings_show_user_recurring';
		$value = set_value($field, element($field, $settings, '0'), FALSE);
		echo form_hidden($field, '0');
		$input = form_checkbox(array(
			'name' => $field,
			'id' => $field,
			'value' => '1',
			'tabindex' => tab_index(),
			'checked' => ($value == '1')
		));
		echo "<label for='{$field}' class='ni'>{$input} Mostrar aos usuários reservas multiplas</label>";

		$field = 'bookings_show_user_single';
		$value = set_value($field, element($field, $settings, '0'), FALSE);
		echo form_hidden($field, '0');
		$input = form_checkbox(array(
			'name' => $field,
			'id' => $field,
			'value' => '1',
			'tabindex' => tab_index(),
			'checked' => ($value == '1')
		));
		echo "<label for='{$field}' class='ni'>{$input} Mostrar usuários de reservas únicas</label>";
		?>

		<p class="hint">Esta configuração controla a visibilidade do usuário de uma reserva na página Reservas.</p>
		<p class="hint">Os detalhes do usuário são sempre exibidos para os administradores e nas reservas do próprio usuário.</p>

	</p>

</fieldset>




<fieldset>

	<legend accesskey="D" tabindex="<?php echo tab_index() ?>">Formatos de data</legend>

	<div>
		As datas seguem o formato PHP - <a href="https://www.php.net/manual/en/function.date.php#refsect1-function.date-parameters" target="_blank">Ver referência</a>.
	</div>

	<p>
		<label for="date_format_long">Formato de data longo</label>
		<?php
		$value = set_value('date_format_long', element('date_format_long', $settings), FALSE);
		echo form_input(array(
			'name' => 'date_format_long',
			'id' => 'date_format_long',
			'size' => '15',
			'maxlength' => '10',
			'tabindex' => tab_index(),
			'value' => $value,
		));
		?>
		<p class="hint">Formato de data longo exibido na parte superior da página de reservas.</p>
	</p>
	<?php echo form_error('date_format_long') ?>

	<p>
		<label for="date_format_weekday">Formato de dia da semana</label>
		<?php
		$value = set_value('date_format_weekday', element('date_format_weekday', $settings), FALSE);
		echo form_input(array(
			'name' => 'date_format_weekday',
			'id' => 'date_format_weekday',
			'size' => '15',
			'maxlength' => '10',
			'tabindex' => tab_index(),
			'value' => $value,
		));
		?>
		<p class="hint">Formato de data abreviada para um dia da semana específico.</p>
	</p>
	<?php echo form_error('date_format_weekday') ?>

	<p>
		<label for="time_format_period">Formato de tempo do período</label>
		<?php
		$value = set_value('time_format_period', element('time_format_period', $settings), FALSE);
		echo form_input(array(
			'name' => 'time_format_period',
			'id' => 'time_format_period',
			'size' => '15',
			'maxlength' => '10',
			'tabindex' => tab_index(),
			'value' => $value,
		));
		?>
		<p class="hint">Formato de hora para períodos.</p>
	</p>
	<?php echo form_error('time_format_period') ?>


</fieldset>


<fieldset>

	<legend accesskey="L" tabindex="<?php echo tab_index() ?>">Mensagem de Login</legend>

	<div>Exibir uma mensagem personalizada para os usuários na página de login.</div>

	<?php
	$field = 'login_message_enabled';
	$value = set_value($field, element($field, $settings, '0'), FALSE);
	?>
	<p>
		<label for="<?= $field ?>">Permitir</label>
		<?php
		echo form_hidden($field, '0');
		echo form_checkbox(array(
			'name' => $field,
			'id' => $field,
			'value' => '1',
			'tabindex' => tab_index(),
			'checked' => ($value == '1')
		));
		?>
	</p>

	<?php
	$field = 'login_message_text';
	$value = set_value($field, element($field, $settings, ''), FALSE);
	?>
	<p>
		<label for="<?= $field ?>">Mensagem</label>
		<?php
		echo form_textarea(array(
			'name' => $field,
			'id' => $field,
			'rows' => '5',
			'cols' => '60',
			'tabindex' => tab_index(),
			'value' => $value,
		));
		?>
	</p>
	<?php echo form_error($field) ?>

</fieldset>

<fieldset>

	<legend accesskey="M" tabindex="<?php echo tab_index() ?>">Modo de manutenção</legend>

	<div>A ativação do Modo de manutenção impede que as contas de Usuários visualizem e façam reservas. Todos os usuários ainda podem fazer login para fazer alterações em suas próprias contas ou alterar suas senhas.</div>

	<p>
		<label for="maintenance_mode">Modo de manutenção</label>
		<?php
		$value = set_value('maintenance_mode', element('maintenance_mode', $settings, '0'), FALSE);
		echo form_hidden('maintenance_mode', '0');
		echo form_checkbox(array(
			'name' => 'maintenance_mode',
			'id' => 'maintenance_mode',
			'value' => '1',
			'tabindex' => tab_index(),
			'checked' => ($value == '1')
		));
		?>
	</p>


	<p>
		<label for="maintenance_mode_message">Mensagem</label>
		<?php
		$field = 'maintenance_mode_message';
		$value = set_value($field, element($field, $settings, ''), FALSE);
		echo form_textarea(array(
			'name' => $field,
			'id' => $field,
			'rows' => '5',
			'cols' => '60',
			'tabindex' => tab_index(),
			'value' => $value,
		));
		?>
		<p class="hint">Esta é a mensagem que será exibida durante o modo de manutenção.</p>
	</p>
	<?php echo form_error($field) ?>

</fieldset>



<?php

$this->load->view('partials/submit', array(
	'submit' => array('Salvar', tab_index()),
	'cancel' => array('Cancelar', tab_index(), 'controlpanel'),
));

echo form_close();
