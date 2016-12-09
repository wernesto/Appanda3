<?php

class Pintu{
	public $clect;
	public $Rdescrip;
	public $sector;
	public $ruta;
	public $s_fecha;
	public $id;
	public $grupo;	
	
	
	public function __construct(
								$_clect=NULL,
								$_Rdescri=NULL,
								$_sector=NULL,
								$_ruta=NULL,
								$_s_fecha=NULL,
								$_id=NULL,
								$_grupo=NULL								
								){
		
		$this->lector = $_clect;
		$this->Rdescri  =$_Rdescri;
		$this->sector = $_sector;
		$this->ruta = $_ruta;
		$this->fecha = $_s_fecha;
		$this->id = $_id;
		$this->grupo = $_grupo;
			
	}
	
	public function add(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO ruta_pintada VALUES ( :lect, :Rdescri, :sector, :ruta, :fecha, :pint, :grupo)";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "ruta_pintada");
	$sth->execute(array(
		
		":lect" => $this->lector,
		":Rdescri"=> $this->Rdescri,
		":sector" => $this->sector,
		":ruta" => $this->ruta,
		":fecha" => $this->fecha,
		":pint" => $this->id,
		":grupo" => $this->grupo
		
	)
);
return $sth->rowCount();
	
	}

public function update(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE ruta_pintada SET rp_cod_lector=:lect, descripcionpin=:Rdescri, rp_id_sector=:sector, rp_id_ruta=:ruta, RPfecha_origen=:fecha, Pin_id_grupo=:grupo WHERE pintu=$this->id";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "ruta_pintada");
	$sth->execute(array(
		
		":lect" => $this->lector,
		":Rdescri"=> $this->Rdescri,
		":sector" => $this->sector,
		":ruta" => $this->ruta,
		":fecha" => $this->fecha,
		":grupo" => $this->grupo
		
	)
);
return $sth->rowCount();
	
	}


	public function delete()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM ruta_pintada WHERE pintu=:id";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ruta_pintada");
		$sth->execute(array(":id"=>$this->lector));
		return $sth->rowCount();
	}
public function getall()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM ruta_pintada";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ruta_pintada");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getcon()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT nombre, id_sector, n_ruta, id_grupo, RPfecha_origen, descripcionpin, pintu  from lectorAvisador,grupo, ruta_pintada, ruta, sector where id_grupo=Pin_id_grupo and codiglector=rp_cod_lector and  id=rp_id_sector and Rid=rp_id_ruta";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ruta_pintada");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
public function getbuscar()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT nombre, id_sector, n_ruta, id_grupo, RPfecha_origen, descripcionpin, pintu  from lectorAvisador,grupo, ruta_pintada, ruta, sector where id_grupo=Pin_id_grupo and codiglector=rp_cod_lector and  id=rp_id_sector and Rid=rp_id_ruta AND RPfecha_origen LIKE '%$this->lector%' ";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ruta_pintada");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}


		Public function getById()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM ruta_pintada WHERE pintu=:pint";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ruta_pintada");
		$sth->execute(array(":pint"=> $this->lector));
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getbuscardia()
	{
		$mesactual = date('y-m-d');
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT nombre, id_sector, n_ruta, id_grupo, RPfecha_origen, descripcionpin, pintu, Rid, id, codiglector  from   lectorAvisador,grupo, ruta_pintada, ruta, sector where RPfecha_origen='$mesactual' and id_grupo=Pin_id_grupo and codiglector=rp_cod_lector and  id=rp_id_sector and Rid=rp_id_ruta ORDER BY RPfecha_origen desc ";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ruta_pintada");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getbuscardia2()
	{
		
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * from   lectorAvisador,grupo, ruta_pintada, ruta, sector where  id_grupo=Pin_id_grupo and codiglector=rp_cod_lector and  id=rp_id_sector and Rid=rp_id_ruta and pintu=$this->lector ORDER BY RPfecha_origen desc ";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ruta_pintada");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}

}



?>