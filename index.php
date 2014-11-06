<?php define('BASEPATH', dirname(__FILE__));
	
header('Content-Type: text/plain; charset=UTF-8');
error_reporting(0);


require_once 'consulta.class.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET'):

		if(isset($_GET['count'])):
			$count = $_GET['count'];
		else:
			$count = 3;
		endif;
	
		if(isset($_GET['orderby'])):
			$orderby = $_GET['orderby'];
		else:
			$orderby = 'id';
		endif;
		
		if(isset($_GET['direct'])):
			$direct = strtoupper($_GET['direct']);
		else:
			$direct = 'DESC';
		endif;
	
		unset($_GET['limit']);
		unset($_GET['orderby']);
		unset($_GET['direct']);
		
		
		
		
			
	if ($_GET):
		
		$consulta = new Consulta;
		$consulta->select('usuarios'  , $_GET, $count, $orderby, $direct);
	endif;
		
	if(empty($_GET)):
		$consulta = new Consulta;
		$consulta->select('usuarios' , null, $count, $orderby, $direct);
	endif;

endif;


if ($_SERVER['REQUEST_METHOD'] == 'POST'):
	exit('Não é permitido o método POST em nossos servidores');
endif;

