<?php

class Ausencia{
	public $c_lector;
	public $fecha_ini;
	public $fecha_fin;
    public $motivo;
	public $observacion;
	public $fechaA;
	public $ida;
	
	
	
	
	
	public function __construct($_c_lector=NULL,
								$_fecha_ini=NULL,
								$_fecha_fin=NULL,
                                $_motivo=NULL,
								$_observacion=NULL,
								$_fechaA=NULL,
								$_ida=null
								
								){
		$this->clector = $_c_lector;
		$this->fechaini   = $_fecha_ini;
		$this->fechafin = $_fecha_fin;
        $this->motivo = $_motivo;
		$this->observacion = $_observacion;
		$this->fechaA = $_fechaA;
		$this->id=$_ida;
		
			
	}
	
	public function add(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO ausencia VALUES (:clector, :fechaini, :fechafin, :motivo ,:Observacion, :fechaA, :id)";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "ausencia");
	$sth->execute(array(
		":clector" => $this->clector,
		":fechaini"=> $this->fechaini,
		":fechafin" => $this->fechafin,
        ":motivo"=> $this->motivo,
		":Observacion" => $this->observacion,
		":fechaA" => $this->fechaA,
		":id"=> $this->id
		
	)
);
return $sth->rowCount();
	
	}

public function update(){
	$pdo= new coneccion();
	$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE ausencia SET au_codigo_lector=:clector, fechainicio=:fechaini, fechafin=:fechafin, motivo=:motivo ,descripcion=:Observacion, fechaor=:fechaA where idau=$this->id";
	$sth = $pdo->db->prepare($sql);
	$sth->setFetchMode(PDO::FETCH_CLASS, "ausencia");
	$sth->execute(array(
		":clector" => $this->clector,
		":fechaini"=> $this->fechaini,
		":fechafin" => $this->fechafin,
        ":motivo"=> $this->motivo,
		":Observacion" => $this->observacion,
		":fechaA" => $this->fechaA
		
		
	)
);
return $sth->rowCount();
	
	}



	public function delete()
	{
		$pdo= new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM ausencia WHERE idau=:clector";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ausencia");
		$sth->execute(array(":clector"=>$this->clector));
		return $sth->rowCount();
	}
	public function getall()
	{
		$pdo= new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT nombre, au_codigo_lector, fechainicio, fechafin, motivo, descripcion, fechaor FROM ausencia, lectoravisador where au_codigo_lector=codiglector";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ausencia");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	Public function getById()
	{
		$pdo = new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM ausencia WHERE auID=:idp";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "agencia");
		$sth->execute(array(":idp"=> $this->clector));
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
	public function getcondiario()
	{
		$mesactual = date('y-m-d');
		$pdo= new coneccion();
		$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT nombre, codiglector, fechainicio, fechafin, motivo, descripcion, fechaor, idau FROM ausencia, lectoravisador where fechaor='$mesactual' and au_codigo_lector=codiglector";
		$sth = $pdo->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_CLASS, "ausencia");
		$sth->execute();
		$rows = $sth->fetchAll(PDO::FETCH_CLASS);
		return $rows;
	}
}

?>