<?php

header('Content-Type:' . "text/plain");

error_reporting(0);


require_once 'usuarios.class.php';

// lista todos os usuarios.
if (empty($_GET)) {
	
	$usuarios = new Usuarios;
	$usuarios->getUsuarios();
	
}

// Pesquisa por nome.
if (!empty($_GET['nome'])){
	
	$nome = $_GET['nome'];
	$usuarios = new Usuarios;
	$usuarios->getUsuariosByNome($nome);

}



