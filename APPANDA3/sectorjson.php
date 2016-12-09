<?php
include 'CLASS/conexion.class.php';
include "CLASS/sector.class.php";
if($_GET){
	$mp= new Sector();
	echo $mp->getBySectorJSON($_GET['id']);
}else{
	$rows=array();
	echo json_encode($rows);
}

?>