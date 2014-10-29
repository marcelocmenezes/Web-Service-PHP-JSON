<?php

require_once 'json.class.php';
require_once 'conexao.php';

class Usuarios {
		
	public function __construct(){

	}
	
	// Usuários
	function getUsuarios(){
		$resultado = mysql_query("SELECT * FROM usuarios");
		$num_rows = mysql_num_rows($resultado);
				
		//Tratando os erros.
		
		//Se retornar erro de tabela.
		if (!$resultado){
			$dados['Mensagem'] = 'Não foi possivel selecionar a Tabela.';
		}

		//Se o numero de Registro for menor que 1.
		else if ($num_rows < 1){
			$dados['Mensagem'] = 'Não há nenhum dado cadastrado.';
		}
		
		//Se não houver erros na consulta.
		else {
			//Gravar os dados em um array.
			//Laço, Para $i até nº de colunas.			
			for($i = 0; $i<$num_rows; $i++) {
				$dados['dados'][$i] = mysql_fetch_assoc($resultado);
			}
			
			$dados['Mensagem'] = $i . ' registros encontrados.';
		}

		return Json::encode($dados);
	}
	
	
	function getUsuariosByNome($nome){
		
		$query = sprintf("SELECT * FROM usuarios WHERE usuario = '%s'", mysql_real_escape_string($nome));
		$resultado = mysql_query($query);
		$num_rows = mysql_num_rows($resultado);
				
		//Tratando os erros.
		
		//Se retornar erro de tabela.
		if (!$resultado){
			$dados['Mensagem'] = 'Não foi possivel selecionar a Tabela.';
		}

		//Se o numero de Registro for menor que 1.
		else if ($num_rows < 1){
			$dados['Mensagem'] = 'Não há nenhum dado cadastrado.';
		}
		
		//Se não houver erros na consulta.
		else {
			
			$dados['dados'] = mysql_fetch_assoc($resultado);
						
			$dados['Mensagem'] = 'registros encontrados.';
		}

		return Json::encode($dados);
	}
	
}

$Json = new Json();