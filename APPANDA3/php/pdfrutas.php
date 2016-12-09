<?php
include 'CLASS/conexion.class.php';
include 'CLASS/grupo.class.php';
include 'CLASS/asigrutas.class.php';
include 'CLASS/lector.class.php';
include 'CLASS/sector.class.php';
include 'CLASS/ruta.class.php';

require('/fpdf/fpdf.php');
require('conexion.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Image('imagen/anda.png' , 10 ,10, 55 , 20,'PNG');
$pdf->Ln(10);
$pdf->Cell(75, 10, '', 0,0);
$pdf->Cell(20, 10, 'Agencias, Grupos, Sectores y Rutas ', 0,1);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(150, 10, 'Hoy: '.date('d-m-Y').'', 0,1);
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(50, 8, '', 0);
$pdf->Cell(20, 10, '"Libro de Rutas Region Oriental"', 0);
$pdf->Ln(10);
$pdf->Cell(85, 8, '', 0);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15, 8, 'N', 1);
$pdf->Cell(35, 8, 'AGENCIA', 1);
$pdf->Cell(35, 8, 'GRUPO', 1);
$pdf->Cell(35, 8, 'SECTOR', 1);
$pdf->Cell(35, 8, 'RUTA', 1);
$pdf->Cell(35, 8, 'USUARIOS', 1);
$pdf->Ln(8);

//CONSULTA
$prov1 = new  Ruta() or die(mysql_error());
$item = 0;
$totaluni = 0;
$totaldis = 0;
$rows4=$prov1->getcondiario2();
foreach ($rows4 as $row4){
	$item = $item+1;
	$pdf->Cell(15, 8, $item, 1);
	$pdf->Cell(35, 8,$row4->id_agencia, 1);
	$pdf->Cell(35, 8, $row4->id_grupo, 1);
	$pdf->Cell(35, 8, $row4->id_sector, 1);
	$pdf->Cell(35, 8, $row4->n_ruta, 1);
	$pdf->Cell(35, 8, $row4->total_usuarios, 1);
	
	
	$pdf->Ln(8);
}

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(104,8,'',0,1);
$pdf->Cell(31,8,'Creador wernesto66',0,1);
$pdf->Output('reportederutas'.date('d-m-Y').'.pdf','D');
?>