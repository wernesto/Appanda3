<?php
class coneccion{

	public $db;
	public function __construct(){
		$this->db = new PDO(
			'mysql:host=localhost;dbname=appanda;charset=utf8',
			'root',
			'root'
			);
	}
}
//$con= new coneccion();
//var_dump($con);
?>