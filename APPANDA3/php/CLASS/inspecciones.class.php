<?php

class Inspecciones{
	public $IS_lector;
	public $IS_sector;
	public $IS_Hruta;
	public $IS_secuencia;
	public $IS_descri;
	public $IS_fecha;
	public $IS_fechaO;
	public $IS_grupo;
	public $id;
	
	
	
	
	
	public function __construct($_IS_lector=NULL,
								$_IS_sector=NULL,
								$_IS_Hruta=NULL,
								$_IS_secuencia=NULL,
								$_IS_descri=NULL,
								$_IS_fecha=NULL,
								$_IS_fechaO=NULL,
								$_IS_grupo=NULL,
								$_id=NULL
								
								){
		$this->islector = $_IS_lector;
		$this->issector   = $_IS_sector;
		$this->isruta = $_IS_Hruta;
		$this->issecuencia = $_IS_secuencia;
		$this->isdecri = $_IS_descri;
		$this->isfecha = $_IS_fecha;
		$this->isfechaO = $_IS_fechaO;
		$this->isgrupo = $_IS_grupo;
		$this->id = $_id;


			
	}
	
	public function add(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO inspecciones VALUES (:islect, :issector, :isruta, :issec, :isdec, :fecha,  :fechaO, :isgrupo, :id)";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "inspecciones");
	$sth->execute(array(
		":islect" => $this->islector,
		":issector"=> $this->issector,
		":isruta" => $this->isruta,
		":issec" => $this->issecuencia,
		":isdec" => $this->isdecri,
		":fecha" => $this->isfecha,
		":fechaO" => $this->isfechaO,
		":isgrupo" => $this->isgrupo,
		":id" => $this->id
		
		
		
		
	)
);
return $sth->rowCount();
	
	}
public function update(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE inspecciones SET in_codigo_lector=:islect, in_sector=:issector, in_ruta=:isruta, in_secuencia=:issec, in_descripcion=:isdec, in_fechaOrigen=:fecha,  in_fecha=:fechaO, in_grupo=:isgrupo WHERE idINSP=$this->id";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "inspecciones");
	$sth->execute(array(
		":islect" => $this->islector,
		":issector"=> $this->issector,
		":isruta" => $this->isruta,
		":issec" => $this->issecuencia,
		":isdec" => $this->isdecri,
		":fecha" => $this->isfecha,
		":fechaO" => $this->isfechaO,
		":isgrupo" => $this->isgrupo		
		
	)
);
return $sth->rowCount();
	
	}



	public function delete()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM inspecciones WHERE idINSP=:islect";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "inspecciones");
		$sth->execute(array(":islect"=>$this->islector));
		return $sth->rowCount();
	}
	public function getcon()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select nombre, in_grupo, id_sector, n_ruta, in_secuencia, in_descripcion, in_fechaOrigen, idINSP from inspecciones, sector,ruta, lectorAvisador where id=in_sector and Rid=in_ruta and codiglector=in_codigo_lector;
";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "inspecciones");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getbuscar()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT nombre, in_grupo, id_sector, n_ruta, in_secuencia, in_descripcion, in_fechaOrigen, idINSP from inspecciones, sector,ruta, lectorAvisador where id=in_sector and Rid=in_ruta and codiglector=in_codigo_lector AND in_fechaOrigen like '%$this->islector%' ;
";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "inspecciones");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}

	public function getcondiario()
	{
		$mesactual = date('y-m-d');
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT nombre, in_grupo, id_sector, n_ruta, in_secuencia, in_descripcion, in_fechaOrigen, idINSP, id_grupo, codiglector,id,Rid from grupo, inspecciones, sector,ruta, lectorAvisador where id_grupo=in_grupo and in_fechaOrigen='$mesactual'   and id=in_sector and Rid=in_ruta and codiglector=in_codigo_lector AND in_fechaOrigen='$mesactual'  ;
";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "inspecciones");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getcondiario2()
	{
		
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * from grupo, inspecciones, sector,ruta, lectorAvisador where id_grupo=in_grupo and id=in_sector and Rid=in_ruta and codiglector=in_codigo_lector and  codiglector  like '%$this->islector%' order by in_fechaOrigen desc  ;
";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "inspecciones");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
}

?>