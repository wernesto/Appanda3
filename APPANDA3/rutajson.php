<?php
include 'CLASS/conexion.class.php';
include "CLASS/ruta.class.php";
if($_GET){
	$mp= new Ruta();
	echo $mp->getBySectorJSON($_GET['id']);
}else{
	$rows=array();
	echo json_encode($rows);
}

?>