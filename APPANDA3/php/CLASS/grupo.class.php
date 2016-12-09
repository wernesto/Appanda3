<?php

class Grupo{
	public $id_grupo;
	public $n_de_agencia;
	public $g_id_fechas;
	
	
	public function __construct($_id_grupo=NULL,
								$_n_de_agencia=NULL,
								$_g_fechas=NULL)
								
								{
		$this->igrupo = $_id_grupo;
		$this->agencia   = $_n_de_agencia;
		$this->gfechas = $_g_fechas;
			
	}
	
	public function add(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO grupo  VALUES (:idc, :g_id_agencia, :n_fechas)";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "grupo");
	$sth->execute(array(
		":idc"       => $this->igrupo,
		":g_id_agencia"=> $this->agencia,
		":n_fechas" => $this->gfechas
		
	)
);
return $sth->rowCount();
	
	}
public function update(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE grupo SET g_id_agencia=:a_agencia, Gfecha=:n_fechas WHERE id_grupo=$this->igrupo";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "grupo");
	$sth->execute(array(
		":a_agencia"=> $this->agencia,
		":n_fechas" => $this->gfechas
		
	)
);
return $sth->rowCount();
	
	}







	public function delete()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM grupo WHERE id_grupo=:idc";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "grupo");
		$sth->execute(array(":idc"=>$this->igrupo));
		return $sth->rowCount();
	}
	public function getall()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM grupo";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "grupo");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getbuscar()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM grupo WHERE Gfecha LIKE '%$this->igrupo%'";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "grupo");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	Public function getById()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM grupo WHERE id_grupo=:idp";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "agencia");
		$sth->execute(array(":idp"=> $this->igrupo));
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getcondiario()
	{
		$hoy = date("y-m-d");
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM grupo WHERE Gfecha='$hoy'";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "grupo");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}

}

?>