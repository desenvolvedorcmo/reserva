<?php
$img = img('assets/images/ui/edit.png', FALSE, "hspace='2' border='0' alt='Editar'");
echo anchor("{$edit}", $img, 'title="Editar"');

$img = img('assets/images/ui/delete.png', FALSE, "hspace='2' border='0' alt='Excluir'");
echo anchor("{$delete}", $img, 'title="Excluir"');
