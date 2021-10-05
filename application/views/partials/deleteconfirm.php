<?php echo form_open( $action, '', array( 'id' => $id ) ); ?>
<br/>
<p class="msgbox question">Tem certeza de que deseja excluir este item??</p>
<?php if( isset($text) ){ ?><p class="msgbox exclamation"><?php echo $text ?></p><?php } ?>
<br /><br />
<table cellpadding="0" cellspacing="0">
	<tr>
		<td align="left" valign="middle">
			<?php echo form_submit( array( 'value' => 'Sim' ) ) ?> &nbsp;&nbsp;&nbsp; <?php echo anchor( $cancel, 'Não') ?>
		</td>
	</tr>
</table>
<?php echo form_close() ?>
