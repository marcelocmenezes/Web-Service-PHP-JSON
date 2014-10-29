<?php

require_once 'json.class.php';
require_once 'conexao.php';

//Cria um instancia da classe Json. 
$Json = new Json();


/*
 * Classe responsável pela listagem de usuário.
 */

class Usuarios {
		
	public function __construct(){

	}
	
	
	/*
	 * Função que exibe todos os usuários. 
	 * 
	 * Return array encoded JSON.
	 */
	
	function getUsuarios(){
		$resultado = mysql_query("SELECT * FROM usuarios");
		$num_rows = mysql_num_rows($resultado);
				
		//Tratando os erros.
		//Se retornar erro de tabela.
		if (!$resultado){
			$dados['Mensagem'] = 'Não foi possivel executar a query';
		}

		//Se o numero de Registro for menor que 1.
		else if ($num_rows < 1){
			$dados['Mensagem'] = 'Nenhum registro encontrado.';
		}
		
		//Se não houver erros na consulta.
		else {
			//Gravar os dados em um array.
			//Laço, Para $i até nº de colunas.			
			for($i = 0; $i<$num_rows; $i++) {
				$dados['dados'][$i] = mysql_fetch_assoc($resultado);
			}
			
			$dados['Mensagem'] = $num_rows . ' registros encontrados.';
		}

		return Json::encode($dados);
	}
	
	
	/*
	 * Função que exibe usuário por nome. 
	 *
	 * Return array encoded JSON.
	 */
	function getUsuariosByNome($nome){
		$query = sprintf("SELECT * FROM usuarios WHERE usuario = '%s'", mysql_real_escape_string($nome));
		$resultado = mysql_query($query);
		$num_rows = mysql_num_rows($resultado);
				
		//Tratando os erros.
		//Se retornar erro de tabela.
		if (!$resultado){
			$dados['Mensagem'] = 'Não foi possivel executar a query.';
		}

		//Se o numero de Registro for menor que 1.
		else if ($num_rows < 1){
			$dados['Mensagem'] = 'Nenhum registro encontrado.';
		}
		
		//Se não houver erros na consulta.
		else {
			$dados['dados'] = mysql_fetch_assoc($resultado);
			$dados['Mensagem'] = $num_rows 'registro encontrados.';
		}

		return Json::encode($dados);
	}
	
}