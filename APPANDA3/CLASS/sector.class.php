<?php

class Sector{
	public $id;
	public $id_sector;
	public $localidad;
	public $s_id_grupo;
	public $s_fecha;
	
	
	
	public function __construct($_id=NULL,
								$_id_sector=NULL,
								$_localidad=NULL,
								$_s_id_grupo=NULL,
								$_fecha=NULL
								){
		$this->idl = $_id;
		$this->sector1 = $_id_sector;
		$this->localidad   =$_localidad;
		$this->sgrupo = $_s_id_grupo;
		$this->sfecha = $_fecha;
			
	}
	
	public function add(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO sector VALUES ( :idl, :ids, :localidad, :s_grupo, :s_fecha)";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "sector");
	$sth->execute(array(
		":idl" => $this->idl,
		":ids" => $this->sector1,
		":localidad"=> $this->localidad,
		":s_grupo" => $this->sgrupo,
		":s_fecha" => $this->sfecha
		
	)
);
return $sth->rowCount();

	}


public function update(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE sector SET id_sector=:ids, localidad=:localid, s_id_grupo=:s_grupo, Sfecha=:s_fecha WHERE id=$this->idl";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "sector");
	$sth->execute(array(
		":ids" => $this->sector1,
		":localid"=> $this->localidad,
		":s_grupo" => $this->sgrupo,
		":s_fecha" => $this->sfecha
		
	)
);
return $sth->rowCount();

	}




	public function delete()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM sector WHERE id = :ids";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "sector");
		$sth->execute(array(":ids"=>$this->idl));
		return $sth->rowCount();
	}
public function getall()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM sector";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "sector");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
public function getbuscar()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM sector where Sfecha like '%$this->sector1%'";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "sector");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
public function getBySector($_id){
	$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql ="SELECT DISTINCT sector.* "
			  ."FROM sector, grupo "
			  ."WHERE sector.s_id_grupo = $_id";
		$sth = $pdo->db->prepare($sql);
		$sth->execute(array(':id'=> $_id));
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getBySectorJSON($id){
		return json_encode($this->getBySector($id));
	}
	Public function getById()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM sector WHERE id=:id";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "sector");
		$sth->execute(array(":id"=> $this->idl));
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getcondiario()
	{
		$hoy=date('y-m-d');
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM sector, grupo where  Sfecha='$hoy' and id_grupo=s_id_grupo";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "sector");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
}

?>