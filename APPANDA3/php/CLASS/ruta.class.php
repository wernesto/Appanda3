<?php

class Ruta{
	public $id;
	public $n_ruta;
	public $total_usuarios;
	public $r_desde;
	public $r_hasta;
	public $fecha;
	public $r_id_sector;
	
	
	
	
	public function __construct($_id=NULL,
								$_n_ruta=NULL,
								$_total_usuarios=NULL,
								$_r_desde=NULL,
								$_r_hasta=NULL,
								$_fecha=NULL,
								$_id_sector=NULL
								){
		$this->id =$_id;
		$this->ruta = $_n_ruta;
		$this->usuarios   = $_total_usuarios;
		$this->desde = $_r_desde;
		$this->hasta = $_r_hasta;
		$this->fecha = $_fecha;
		$this->ids = $_id_sector;
			
	}
	
	public function add(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO ruta VALUES (:r_id, :n_ruta, :total_usuarios, :r_desde, :r_hasta, :_fecha, :idr)";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "ruta");
	$sth->execute(array(
        "r_id" => $this->id,
		":n_ruta" => $this->ruta,
		":total_usuarios"=> $this->usuarios,
		":r_desde" => $this->desde,
		":r_hasta" => $this->hasta,
		":_fecha" => $this->fecha,
		":idr" => $this->ids
		
	)
);
return $sth->rowCount();
	
	}
	public function delete()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM ruta WHERE Rid=:id";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ruta");
		$sth->execute(array(":id"=>$this->id));
		return $sth->rowCount();
	}
public function getcon(){
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT agencia.id_agencia, grupo.id_grupo, sector.id_sector, ruta.n_ruta FROM agencia, grupo, sector, ruta WHERE id_agencia=g_id_agencia AND id_grupo=s_id_grupo AND id=r_id_sector" ;
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ruta");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	
	}
	public function getall(){
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT Rid, id_sector, n_ruta, total_usuarios, r_desde, r_hasta, Rfecha FROM ruta, sector where id=r_id_sector" ;
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ruta");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	
	}
	public function getBySector($id){
	$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql ="SELECT DISTINCT ruta.* "
			  ."FROM sector, ruta "
			  ."WHERE ruta.r_id_sector=:idp ";
		$sth = $pdo->db->prepare($sql);
		$sth->execute(array('idp'=> $id));
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getBySectorJSON($id){
		return json_encode($this->getBySector($id));
	}
	Public function getById()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM ruta WHERE Rid=:idp";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ruta");
		$sth->execute(array(":idp"=> $this->ruta));
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getcondiario(){
		$hoy=date('y-m-d');
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT agencia.id_agencia, grupo.id_grupo, sector.id_sector, ruta.Rid, ruta.n_ruta,  ruta.total_usuarios, ruta.r_hasta, ruta.r_desde, ruta.Rfecha FROM agencia, grupo, sector, ruta WHERE Rfecha='$hoy' and id_agencia=g_id_agencia AND id_grupo=s_id_grupo AND id=r_id_sector" ;
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ruta");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	
	}
	public function getcondiario2(){
		
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT agencia.id_agencia, grupo.id_grupo, sector.id_sector, ruta.Rid, ruta.n_ruta,  ruta.total_usuarios, ruta.r_hasta, ruta.r_desde, ruta.Rfecha FROM agencia, grupo, sector, ruta WHERE  id_agencia=g_id_agencia AND id_grupo=s_id_grupo AND id=r_id_sector" ;
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ruta");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	
	}
}

?>