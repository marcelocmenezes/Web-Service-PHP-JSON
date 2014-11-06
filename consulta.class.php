<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('json.class.php');
$JSON = new JSON;

/*
 * Desenvolvido por Marcelo Menezes.
 * email: menezes_07@hotmail.com
 *
 * Classe que executa uma Query SQL em nosso WebService.
 */

class  Consulta {
	
	/*
	 * Variável que que vai instanciar nossa conexão com o Banco de Dados.
	 */
	protected $conexao;
	
	/*
	 * Constante com o hostname do Banco de Dados.
	 */
	const HOSTNAME = 'localhost';
			
	/*
	 * Constante com a Senha do Usuário do Banco de Dados.
	 */
	const PORTA = '3305';
	
	/*
	 * Constante com o nome do Banco de Dados.
	 */
	const DB = 'ws';
	
	/*
	 * constante com o Usuário do Banco de Dados.
	 */
	const USUARIO = 'root';
	
	/*
	 * Constante com a Senha do Usuário do Banco de Dados.
	 */
	const SENHA = '';
	
	/*
	 * Função construtora da nossa Classe;
	 */			
	public function __construct(){
		$this->conectar();		
	}
	
	/*
	 * Função destrutora da nossa Classe;
	 */	
	public function __destruct(){
		$this->desconectar();
	}
	
	/*
	 * Função que conecta o Banco de Dados;
	 */	
	private function conectar(){
		try {
			$this->conexao = new PDO('mysql:hostname='. self::HOSTNAME .';
											dbport='. self::PORTA .';
											dbname='. self::DB .';', 
											self::USUARIO, 
											self::SENHA);
		}
		catch(PDOException $e){
			echo $e->getMessage();
			exit();
		}				
	}
	
	/*
	 * Função que desconecta o Banco de Dados;
	 */	
	private function desconectar(){
		$this->conexao = null;
	}
	
	/*
	 * Função que faz o SELECT em nosso Banco de Dados.
	 * string	$tabela = nome da tabela que vai ser consultada.
	 * array	$params = parâmetros da consulta. WHERE $params;
	 * interger	$limit	= número de registros a ser retornado.
	 */	
	public function select($tabela, $params = null, $limit = 5){
		if (empty($tabela)):
			die('Nenhuma tabela selecionada');
		endif;
	
		if(is_string($tabela)):
			if($params == null):
				$sql = $this->conexao->prepare('SELECT * FROM '. $tabela .' LIMIT '. $limit);
				$sql->execute();
				for($i = 0; $i<$sql->rowCount(); $i++){
					$dados['dados'][] = $sql->fetch(PDO::FETCH_ASSOC);
				}
			
				echo JSON::encode($dados);
			endif;
			
			if(is_array($params)):
				foreach($params as $chave => $valor):
			 		$where[] = $chave. ' = :' .$chave; 
				endforeach;
	 		
		 		$where = ' WHERE ' .implode(' AND ', $where);
				$sql = $this->conexao->prepare('SELECT * FROM '. $tabela . $where .' LIMIT '. $limit);
				
				foreach($params as $chave => $valor):
					$sql->bindValue(':'.$chave, $valor);
				endforeach;
				$sql->execute();	
				for($i = 0; $i<$sql->rowCount(); $i++){
					$dados['dados'][] = $sql->fetch(PDO::FETCH_ASSOC);
				}
				
				
				$e = $sql->errorinfo();
				$dados['mensagem'] = array(self::erro($e[1]), 'Retornou '.$sql->rowCount().' registro(s).');
		
				echo JSON::encode($dados);
			endif;
				
		endif;
		
		$this->desconectar();		
		
	}
	
	/*
	 * Função de tratamento de erros do MySQL;
	 */	
	protected function erro($code){
	
		if ( $code == 0000):
			return 'Query executada com sucesso!';
		endif;
		
		if ($code == 1146):
			return 'Tabela não existe.';
		endif;

	}
	
}