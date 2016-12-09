<?php
include 'conexion.class.php';
$pdo = new coneccion();
var_dump($pdo)
$pdo->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>