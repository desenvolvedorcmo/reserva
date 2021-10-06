<?php
echo $this->session->flashdata('saved');

echo iconbar(array(
	array('profile/edit', 'Editar perfil', 'user_edit.png'),
));

?>

<?php if($myroom){ ?>
<h3>Staff bookings in my rooms</h3>
<ul>
<?php
foreach($myroom as $booking){
	$string = '<li>%s is booked on %s by %s for %s. %s</li>';
	if($booking->notes){ $booking->notes = '('.$booking->notes.')'; }
	if(!$booking->displayname){ $booking->displayname = $booking->username; }
	echo sprintf($string, html_escape($booking->name), date("d/m/Y", strtotime($booking->date)), html_escape($booking->displayname), html_escape($booking->periodname), html_escape($booking->notes));
}
?>
</ul>
<?php } ?>



<?php if($mybookings){ ?>
<h3>My bookings</h3>
<ul>
<?php
foreach($mybookings as $booking){
	$string = '<li>%s is booked on %s for %s. %s.</li>';
	$notes = '';
	if($booking->notes){ $notes = '('. $booking->notes.')'; }
	echo sprintf($string, html_escape($booking->name), date("d/m/Y", strtotime($booking->date)), html_escape($booking->periodname), html_escape($notes));
}
?>
</ul>
<?php } ?>


<h3>Total de reservas</h3>
<ul>
	<li>N&uacute;mero de reservas realizadas: <?php echo $total['all'] ?></li>
	<li>N&uacute;mero de reservas do ano corrente até a data atual: <?php echo $total['yeartodate'] ?></li>
	<li>N&uacute;mero de reservas atualmente ativas: <?php echo $total['active'] ?></li>
</ul>
