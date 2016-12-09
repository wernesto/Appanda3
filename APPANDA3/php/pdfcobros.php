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
require('/fpdf/fpdf.php');
require('conexion.php');

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Image('imagen/anda.png' , 10 ,10, 55 , 20,'PNG');
$pdf->Ln(10);
$pdf->Cell(75, 10, '', 0,0);
$pdf->Cell(20, 10, '', 0,1);
$pdf->SetFont('Arial', '', 9);

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(20, 10, '"CONTROL DE COBROS ESPECIALES Y QUEDAN"', 0);
$pdf->Ln(10);
$pdf->Cell(85, 8, '', 0);
$pdf->Cell(30, 8, 'Desde: '.$verDesde.' hasta: '.$verHasta, 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 8, 'N', 1);
$pdf->Cell(15, 8, 'CODIGO', 1);
$pdf->Cell(40, 8, 'NOMBRE', 1);
$pdf->Cell(35, 8, 'APELLIDO', 1);
$pdf->Cell(40, 8, 'REFERENCIA', 1);
$pdf->Cell(50, 8, 'OBSERVACION', 1);
$pdf->Cell(20, 8, 'FECHA', 1);



$pdf->Ln(8);

//CONSULTA
$productos = mysql_query("SELECT * from cobroespecial,lectorAvisador where codiglector=codigo_lec  and  fecha_asig BETWEEN '$desde' AND '$hasta' ORDER BY fecha_asig desc");
$item = 0;
$totaluni = 0;
$totaldis = 0;
while($productos2 = mysql_fetch_array($productos)){
	$item = $item+1;
	$pdf->Cell(10, 8, $item, 1);
	$pdf->Cell(15, 8,$productos2['codiglector'], 1);
	$pdf->Cell(40, 8, $productos2['nombre'], 1);
	$pdf->Cell(35, 8, $productos2['apellido'], 1);
	$pdf->Cell(40, 8, $productos2['n_cuenta_c'], 1);
	$pdf->Cell(50, 8, $productos2['c_descripcion'], 1);
	$pdf->Cell(20, 8, $productos2['fecha_asig'], 1);
	
	
	
	$pdf->Ln(8);
}

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(104,8,'',0,1);
$pdf->Cell(31,8,'Oscar Ernesto Romero Campos',0,1);
$pdf->Cell(50,8,'Auxiliar de Lectura y Aviso ',0,0);
$pdf->Cell(150, 10, 'Hoy: '.date('d-m-Y').'', 0,1);

$pdf->Output('reporteCobros'.date('d-m-Y').'.pdf','D');
?>