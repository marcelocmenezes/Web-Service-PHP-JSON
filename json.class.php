<?php
class Json{
	
	public function encode($dados){ 
		echo json_encode($dados, 128);
	}
}
