<?php
$conexion = mysql_connect('127.0.0.1','root', 'root');
mysql_select_db('appanda', $conexion);

function fechaNormal($fecha){
		$nfecha = date('d/m/Y',strtotime($fecha));
		return $nfecha;
}
?>