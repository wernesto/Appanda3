<?php

class Agencia{
	public $id;
	public $n_agencia;
	public $fechas;
	
	
	public function __construct($_id=NULL,
								$_n_agencia=NULL,
								$_fechas=NULL
								){
		$this->id = $_id;
		$this->agencia = $_n_agencia;
		$this->fechas = $_fechas;	
	}
	
	public function add(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO agencia VALUES (:idp, :n_agencia,:fechas)";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "agencia");
	$sth->execute(array(
		":idp" => $this->id,
		":n_agencia" => $this->agencia,
		":fechas" =>$this->fechas
		
	)
);
return $sth->rowCount();
	
	}
	public function delete()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM agencia WHERE id_agencia=:idp";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "agencia");
		$sth->execute(array(":idp"=>$this->id));
		return $sth->rowCount();
	}
	public function getall()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM agencia";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "agencia");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getbuscar()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM agencia where Afecha LIKE '%$this->id%' " ;
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "agencia");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	

	public function getcon(){
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT agencia.id_agencia, grupo.id_grupo, sector.id_sector, ruta.n_ruta FROM agencia,grupo,sector,ruta WHERE id_agencia=g_id_agencia AND grupo=s_id_grupo AND id_sector=r_id_sector" ;
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "agencia");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	
	}
	public function update(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE agencia SET id_agencia=:idp, n_de_agencia=:n_agencia, Afecha=:fechas WHERE id_agencia=$this->id";

	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "agencia");
	$sth->execute(array(
		":idp" => $this->id,
		":n_agencia" => $this->agencia,
		":fechas" =>$this->fechas
		
	)
);
return $sth->rowCount();
	
	}

	Public function getById()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM agencia WHERE id_agencia=:idp";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "agencia");
		$sth->execute(array(":idp"=> $this->id));
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getcondiario(){
		$mes = date("y-m-d");
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT id_agencia, n_de_agencia, Afecha FROM agencia where Afecha='$mes'" ;
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "agencia");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	
	}
}

?>