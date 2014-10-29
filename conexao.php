<?php

	mysql_connect('hostname', 'username', 'password') or die('Erro ao conectar com o Banco de Dados');
	mysql_select_db('database') or die('Erro ao selecionar o Banco de Dados');
	