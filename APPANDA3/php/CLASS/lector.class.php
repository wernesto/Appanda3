<?php

class lectorAvisador{
	
	public $nombre;
	public $apellido;
	public $codigolector;
	public $sexo;
	public $telefono;
	public $dui;
	public $fecha_origen;
	public $nit;
	public $afp;
	public $tipo;
	public $descripcion;
	public $Lfecha;
	public $activ;
	
	
	
	
	
	
	public function __construct($_nombre=NULL,
								$_apellido=NULL,
								$_codigolector=NULL,
								$_sexo=NULL,
								$_telefono=NULL,
								$_dui=NULL,
								$_fecha_origen=NULL,
								$_nit=NULL,
								$_afp=NULL,
								$_tipo=NULL,
								$_descripcion=NULL,
								$_Lfecha=NULL,
								$_activ=NULL
								
								){
		
		$this->nombre = $_nombre;
		$this->apellido = $_apellido;
		$this->codigo = $_codigolector;
		$this->sexo = $_sexo;
		$this->telefono = $_telefono;	
		$this->dui = $_dui;
		$this->fechaO = $_fecha_origen;
		$this->nit = $_nit;
		$this->afp = $_afp;	
		$this->tipo = $_tipo;
		$this->descripcion = $_descripcion;	
		$this->fechaW=$_Lfecha;
		$this->activ=$_activ;
		
	}
	
	public function add(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT  INTO lectorAvisador VALUES (:nombre, :apellido, :codigo, :sexo, :telefono, :dui, :Mfecha, :nit, :afp, :tipo, :descripcion, :Lfecha, :activ)";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "lectorAvisador");
	$sth->execute(array(
		
		":nombre"=> $this->nombre,
		":apellido" => $this->apellido,
		":codigo" => $this->codigo,
		":sexo" => $this->sexo,
		":telefono" => $this->telefono,
		":dui" => $this->dui,
		":Mfecha" => $this->fechaO,
		":nit" => $this->nit,
		":afp" => $this->afp,
		":tipo" => $this->tipo,
		":descripcion" => $this->descripcion,
		":Lfecha"=> $this->fechaW,
		":activ"=> $this->activ
		
	)
);
return $sth->rowCount();
	
	}
	public function delete()
	{
		$pdo= new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM lectorAvisador WHERE codiglector=:nombre";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "lectorAvisador");
		$sth->execute(array(":nombre"=>$this->nombre));
		return $sth->rowCount();
	}
	
	public function getall()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM lectorAvisador where activ=1";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "lectorAvisador");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	
public function update(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE lectorAvisador SET nombre=:nombre, apellido=:apellido, codiglector=:codigo, sexo=:sexo, telefono=:telefono, dui=:dui, nit=:Mfecha, afp=:nit, lec_descripcion=:afp, fecha_origen=:tipo, Afecha=:descripcion, tipo=:Lfecha, activ=:activ where codiglector=$this->codigo";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "lectorAvisador");
	$sth->execute(array(
		
		":nombre"=> $this->nombre,
		":apellido" => $this->apellido,
		":codigo" => $this->codigo,
		":sexo" => $this->sexo,
		":telefono" => $this->telefono,
		":dui" => $this->dui,
		":Mfecha" => $this->fechaO,
		":nit" => $this->nit,
		":afp" => $this->afp,
		":tipo" => $this->tipo,
		":descripcion" => $this->descripcion,
		":Lfecha"=> $this->fechaW,
		":activ"=> $this->activ
		
	)
);
return $sth->rowCount();
	
	}

	Public function getById()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM lectorAvisador WHERE codiglector=:idp and activ=1";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "lectorAvisador");
		$sth->execute(array(":idp"=> $this->nombre));
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getcondiario()
	{
		$hoy=date('y-m-d');
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM lectorAvisador where fecha_origen='$hoy' order by codiglector  desc";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "lectorAvisador");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}

public function getcondiario3()
	{
		
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM lectorAvisador where codiglector LIKE '%$this->nombre%'  order by  fecha_origen desc";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "lectorAvisador");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getcondiario4()
	{
		$hoy=date('y-m-d');
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM lectorAvisador";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "lectorAvisador");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}


	public function activate(){

	$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE lectoravisador SET activ=:apellido WHERE codiglector=$this->nombre";
		$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "lectorAvisador");
	$sth->execute(array(
		
		
		":apellido" => $this->apellido
		
		)
	);
		return $sth->rowCount();
	}
	public function detivate(){
	$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE lectoravisador SET activ=:apellido WHERE codiglector=$this->nombre";
		$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "lectorAvisador");
	$sth->execute(array(
		
		
		":apellido" => $this->apellido
		
	)
);
		return $sth->rowCount();
	}

}

?>