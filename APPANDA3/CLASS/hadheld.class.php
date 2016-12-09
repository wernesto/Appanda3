<?php

class Handheld{
	public $H_lector;
	public $N_equipo;
	public $N_impresora;
	public $Hdescri;
	public $fechaH;
	public $id;
	
	
	
	
	
	public function __construct($_H_lector=NULL,
								$_N_equipo=NULL,
								$_N_impresora=NULL,
								$_Hdescri=NULL,
								$_fechaH=NULL,
								$_id=NULL
								
								){
		$this->hlector = $_H_lector;
		$this->nequipo   = $_N_equipo;
		$this->nimpresora = $_N_impresora;
		$this->Hdescri = $_Hdescri;
		$this->fechah = $_fechaH;
		$this->id = $_id;
		
			
	}
	
	public function add(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO asighandheld VALUES (:hlect, :nequi, :nimp, :Hdes, :fec, :id)";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "asighandheld");
	$sth->execute(array(
		":hlect" => $this->hlector,
		":nequi"=> $this->nequipo,
		":nimp" => $this->nimpresora,
		":Hdes" => $this->Hdescri,
		":fec" => $this->fechah,
		":id" => $this->id
		
	)
);
return $sth->rowCount();
	
	}

		public function update(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE asighandheld SET HH_codigo_lector=:hlect, n_de_equipo=:nequi, n_de_impresora=:nimp, ASdescripcion=:Hdes, HHfecha_origen=:fec WHERE HHid=$this->id";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "asighandheld");
	$sth->execute(array(
		":hlect" => $this->hlector,
		":nequi"=> $this->nequipo,
		":nimp" => $this->nimpresora,
		":Hdes" => $this->Hdescri,
		":fec" => $this->fechah
		
		
	)
);
return $sth->rowCount();
	
	}
	public function delete()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM asighandheld WHERE HHid=:hlect";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "asighandheld");
		$sth->execute(array(":hlect"=>$this->hlector));
		return $sth->rowCount();
	}
	public function getcon()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select nombre, n_de_equipo, n_de_impresora,HHfecha_origen,ASdescripcion,HHid from lectorAvisador, asighandheld where codiglector=HH_codigo_lector";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "asighandheld");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
public function getbuscar()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT nombre, n_de_equipo, n_de_impresora,HHfecha_origen,ASdescripcion,HHid from lectorAvisador, asighandheld where codiglector=HH_codigo_lector AND HHfecha_origen like '%$this->hlector%'";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "asighandheld");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}

	Public function getById()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM asighandheld WHERE HHid=:hlect";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "asighandheld");
		$sth->execute(array(":hlect"=> $this->hlector ));
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}

	public function getcondiario()
	{
		$mesactual = date('y-m-d');
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select nombre, n_de_equipo, n_de_impresora,HHfecha_origen,ASdescripcion,HHid from lectorAvisador, asighandheld where  HHfecha_origen='$mesactual' and codiglector=HH_codigo_lector";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "asighandheld");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}

}

?>