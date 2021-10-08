<?php

echo $this->session->flashdata('saved');

$iconbar = iconbar(array(
	array('holidays/add', 'Adicionar feriado', 'add.png'),
));

echo $iconbar;

$sort_cols = ["Name", "StartDate", "EndDate", "None"];

?>

<table width="100%" cellpadding="2" cellspacing="2" border="0" class="zebra-table sort-table" id="jsst-holidays" up-data='<?= json_encode($sort_cols) ?>'>
	<col /><col /><col /><col />
	<thead>
	<tr class="heading">
		<td class="h" title="Name">Nome</td>
		<td class="h" title="StartDate">Início</td>
		<td class="h" title="EndDate">Término</td>
		<td class="h" title="Duration">Duração</td>
		<td class="n" title="X"></td>
	</tr>
	</thead>
	<tbody>
	<?php
	$i=0;
	if($holidays){
	foreach( $holidays as $holiday ){
	?>
	<tr>
		<td><?php echo html_escape($holiday->name) ?></td>
		<td><?php echo date("d/m/Y", strtotime($holiday->date_start)); ?></td>
		<td><?php echo date("d/m/Y", strtotime($holiday->date_end)) ?></td>
		<td><?php
		if(strtotime($holiday->date_start) != strtotime($holiday->date_end)){
			echo timespan(strtotime($holiday->date_start), strtotime($holiday->date_end) + (3600*24));
		} else {
			echo "1 Dia";
		}
		?></td>
		<td width="45" class="n"><?php
			$actions['edit'] = 'holidays/edit/'.$holiday->holiday_id;
			$actions['delete'] = 'holidays/delete/'.$holiday->holiday_id;
			$this->load->view('partials/editdelete', $actions);
			?>
		</td>
	</tr>
	<?php $i++; }
	} else {
		echo '<td colspan="4" align="center" style="padding:16px 0">Sem feriados definidos!</td>';
	}
	?>
	</tbody>
</table>

<?php

echo $iconbar;
