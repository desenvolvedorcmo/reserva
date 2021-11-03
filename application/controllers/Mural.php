<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mural extends MY_Controller
{
	$servidor = "localhost";
	$usuario = "root";
	$senha = "123";
	$dbname = "reserva";
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
}



?>