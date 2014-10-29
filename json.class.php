<?php

/*
 * Classe responsável pelo Encode dos dados em jSON.
 */

class Json{
	/*
	 * Função que faz o encode jSon.
	 *
	 * Return jSON file.
	 */
	public function encode($dados){ 
		echo json_encode($dados, 128); //128 = JSON_PRETTY_PRINT
	}
}
