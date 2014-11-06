<?php define('BASEPATH', dirname(__FILE__));
	
header('Content-Type: text/plain; charset=UTF-8');
error_reporting(0);


require_once 'consulta.class.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET'):
		
	if ($_GET):
		$consulta = new Consulta;
		$consulta->select('usuario'  , $_GET);
	endif;
		
	if(empty($_GET)):
		$consulta = new Consulta;
		$consulta->select('usuarios' , null, 4);
	endif;

endif;

if ($_SERVER['REQUEST_METHOD'] == 'POST'):
	exit('Não é permitido o método POST em nossos servidores');
endif;

