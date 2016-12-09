<?php

class Asigruta{
	
	public $rut_fecha;
	Public $periodo;
	public $herramienta;
	public $rut_grupo;
	public $rut_sector;
	public $rut_Hruta;
	public $rut_lector;
	public $rut_fechaO;
	public $rut_descri;
	public $id;
	
	
	
	
	
	public function __construct(
								$_rut_fecha=NULL,
								$_periodo=NULL,
								$_herramienta=NULL,
								$_rut_grupo=NULL,
								$_rut_sector=NULL,
								$_rut_Hruta=NULL,
								$_rut_lector=NULL,
								$_rut_fechaO=NULL,
								$_rut_descri=NULL,
								$_id=NULL
								
								){
		$this->rutfecha = $_rut_fecha;
		$this->periodo = $_periodo;
		$this->herramienta = $_herramienta;
		$this->rutgrupo = $_rut_grupo;
		$this->rutsector   = $_rut_sector;
		$this->rutruta = $_rut_Hruta;
		$this->rutlector = $_rut_lector;
		$this->rutfechaO = $_rut_fechaO;
		$this->rutdecri = $_rut_descri;
		$this->id = $_id;


			
	}
	
	public function add(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO asignacion VALUES (:rufech, :ruperiod, :ruherr, :rugrupo, :rusect, :ruruta,  :rucodig, :ruofecha, :roobserv)";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "asignacion");
	$sth->execute(array(
		":rufech" => $this->rutfecha,
		":ruperiod"=> $this->periodo,
		":ruherr" => $this->herramienta,
		":rugrupo" => $this->rutgrupo,
		":rusect" => $this->rutsector,
		":ruruta" => $this->rutruta,
		":rucodig" => $this->rutlector,
		":ruofecha" => $this->rutfechaO,
		":roobserv"=> $this->rutdecri
		
		
		
		
	)
);
return $sth->rowCount();
	
	}

	public function update(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE asignacion SET fecha_asig=:rufech, herramienta=:ruperiod, ar_grupo=:ruherr, ar_id_sector=:rugrupo, ar_nruta=:rusect, ar_codigolec=:ruruta,  Asfecha_origen=:rucodig, ar_observacionasig=:ruofecha WHERE asigID=$this->rutdecri";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "asignacion");
	$sth->execute(array(
		":rufech" => $this->rutfecha,
		":ruperiod"=> $this->periodo,
		":ruherr" => $this->herramienta,
		":rugrupo" => $this->rutgrupo,
		":rusect" => $this->rutsector,
		":ruruta" => $this->rutruta,
		":rucodig" => $this->rutlector,
		":ruofecha" => $this->rutfechaO		
		
	)
);
return $sth->rowCount();
	
	}

	public function getcon()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT asigID, fecha_asig, nombre, ar_grupo, id_sector, n_ruta, periodo, herramienta, ar_observacionasig FROM grupo,sector,ruta,lectorAvisador,asignacion WHERE id_grupo=ar_grupo and  id=ar_id_sector and Rid=ar_nruta and  codiglector=ar_codigolec";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "asignacion");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getcon2()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT asigID, fecha_asig, nombre, ar_grupo, id_sector, n_ruta, periodo, herramienta, ar_observacionasig FROM grupo,sector,ruta,lectorAvisador,asignacion WHERE id_grupo=ar_grupo and  id=ar_id_sector and Rid=ar_nruta and  codiglector=ar_codigolec LIMIT $this->rutfecha, $this->periodo";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "asignacion");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	
	
	public function delete()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM asignacion WHERE asigID=:rufech";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "asignacion");
		$sth->execute(array(":rufech"=>$this->rutfecha));
		return $sth->rowCount();
	}
	Public function getById()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM asignacion WHERE asigID=:id";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "asignacion");
		$sth->execute(array(":id"=> $this->rutfecha ));
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}

	public function getdiario()
	{
		$mesactual = date('y-m-d');
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * from asignacion, ruta,  grupo, lectoravisador, sector WHERE  Asfecha_origen='$mesactual' and ar_codigolec=codiglector and ar_grupo=id_grupo  and ar_id_sector=id and ar_nruta=Rid";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "asignacion");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getdiario2()
	{
	
		$pdo= new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * from asignacion, ruta,  grupo, lectoravisador, sector WHERE  ar_codigolec=codiglector and ar_grupo=id_grupo  and ar_id_sector=id and ar_nruta=Rid like '%$this->rutfecha%' or codiglector like '%$this->rutfecha%' order by fecha_asig,ar_grupo,id,Rid desc";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "asignacion");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getdiario3()
	{
		
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * from asignacion, ruta,  grupo, lectoravisador, sector WHERE ar_codigolec=codiglector and ar_grupo=id_grupo  and ar_id_sector=id and ar_nruta=Rid AND asigID=$this->rutfecha";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "asignacion");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}

}

?>