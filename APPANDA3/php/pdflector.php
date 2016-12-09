<?php

if(strlen($_GET['desde'])>0 and strlen($_GET['hasta'])>0){
	$desde = $_GET['desde'];
	$hasta = $_GET['hasta'];

	$verDesde = date('d/m/Y', strtotime($desde));
	$verHasta = date('d/m/Y', strtotime($hasta));
}else{
	$desde = '1111-01-01';
	$hasta = '9999-12-30';

	$verDesde = '__/__/____';
	$verHasta = '__/__/____';
}
require('fpdf/fpdf.php');
require('conexion.php');

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Image('imagen/anda.png' , 10 ,10, 55 , 20,'PNG');
$pdf->Ln(10);
$pdf->Cell(75, 10, '', 0,0);
$pdf->Cell(20, 10, 'LECTORES Y AVISADORES  ', 0,1);
$pdf->SetFont('Arial', '', 9);

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(115, 8, '', 0);
$pdf->Cell(20, 10, '"TELEFONOS Y CODIGOS"', 0);
$pdf->Ln(10);
$pdf->Cell(85, 8, '', 0);
$pdf->Cell(30, 8, 'Desde: '.$verDesde.' hasta: '.$verHasta, 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(15, 8, 'N', 1);
$pdf->Cell(25, 8, 'CODIGO', 1);
$pdf->Cell(50, 8, 'NOMBRE', 1);
$pdf->Cell(45, 8, 'APELLIDO', 1);
$pdf->Cell(45, 8, 'TELEFONO', 1);
$pdf->Cell(60, 8, 'FIRMA', 1);


$pdf->Ln(8);

//CONSULTA
$productos = mysql_query("SELECT * from lectoravisador WHERE  activ!=0 ORDER BY codiglector desc");
$item = 0;
$totaluni = 0;
$totaldis = 0;
while($productos2 = mysql_fetch_array($productos)){
	$item = $item+1;
	$pdf->Cell(15, 8, $item, 1);
	$pdf->Cell(25, 8,$productos2['codiglector'], 1);
	$pdf->Cell(50, 8, $productos2['nombre'], 1);
	$pdf->Cell(50, 8, $productos2['apellido'], 1);
	$pdf->Cell(45, 8, $productos2['telefono'], 1);
	$pdf->Cell(60, 8, '', 1);
	
	
	
	$pdf->Ln(8);
}


$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(104,8,'',0,1);
$pdf->Cell(31,8,'Oscar Ernesto Romero Campos',0,1);
$pdf->Cell(50,8,'Auxiliar de Lectura y Aviso ',0,0);
$pdf->Cell(150, 10, 'Hoy: '.date('d-m-Y').'', 0,1);

$pdf->Output('LECTORES'.date('d-m-Y').'.pdf','D');
?>