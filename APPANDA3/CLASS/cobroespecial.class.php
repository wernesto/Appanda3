<?php

class Cobro{
	public $P_lector;
	public $N_cuenta;
	public $fechaP;
	public $fechaA;
	public $descrip;
	public $id;
	
	
	
	
	
	public function __construct($_P_lector=NULL,
								$_N_cuenta=NULL,
								$_fechaP=NULL,
								$_fechaA=NULL,
								$_descri=NULL,
								$_id=NULL
								
								){
		$this->Pclector = $_P_lector;
		$this->Ncuenta   = $_N_cuenta;
		$this->fechaP = $_fechaP;
		$this->fechaA = $_fechaA;
		$this->descrip = $_descri;
		$this->id = $_id;
		
			
	}
	
	public function add(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO cobroespecial VALUES (:clector, :ncuenta, :fechap, :fechaA, :descrip,:id)";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "cobroespecial");
	$sth->execute(array(
		":clector" => $this->Pclector,
		":ncuenta"=> $this->Ncuenta,
		":fechap" => $this->fechaP,
		":fechaA" => $this->fechaA,
		"descrip" => $this->descrip,
		":id" => $this->id
		
	)
);
return $sth->rowCount();
	
	}

public function update(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE cobroespecial SET codigo_lec=:clector, n_cuenta_c=:ncuenta, fecha_asig=:fechap, Cfecha_origen=:fechaA, c_descripcion=:descrip WHERE cobrID=$this->id";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "cobroespecial");
	$sth->execute(array(
		":clector" => $this->Pclector,
		":ncuenta"=> $this->Ncuenta,
		":fechap" => $this->fechaP,
		":fechaA" => $this->fechaA,
		"descrip" => $this->descrip
		
	)
);
return $sth->rowCount();
	
	}

	public function delete()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM cobroespecial WHERE cobrID=:clector";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "cobroespecial");
		$sth->execute(array(":clector"=>$this->Pclector));
		return $sth->rowCount();
	}
	public function getcon()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "select nombre, n_cuenta_c, fecha_asig, c_descripcion,  cobrID  from cobroespecial,lectorAvisador where codiglector=codigo_lec";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "cobroespecial");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}

public function getbuscar()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT nombre, n_cuenta_c, fecha_asig, c_descripcion,  cobrID  from cobroespecial,lectorAvisador where codiglector=codigo_lec and fecha_asig like '%$this->Pclector%'";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "cobroespecial");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}


	Public function getById()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM cobroespecial WHERE cobrID=:clector";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "cobroespecial");
		$sth->execute(array(":clector"=> $this->Pclector));
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getbuscardiario()
	{
		$mesactual = date('y-m-d');
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT nombre, n_cuenta_c, fecha_asig, c_descripcion, cobrID, codiglector from cobroespecial,lectorAvisador where codiglector=codigo_lec and fecha_asig='$mesactual' ";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "cobroespecial");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getbuscardiario2()
	{
		
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT nombre, n_cuenta_c, fecha_asig, c_descripcion, cobrID, codiglector from cobroespecial,lectorAvisador where codiglector=codigo_lec and cobrID=$this->Pclector ";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "cobroespecial");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
}

?>