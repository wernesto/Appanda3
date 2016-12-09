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
$pdf->Image('imagen/gob.png' , 210 ,10, 55 , 20,'PNG');
$pdf->Ln(10);
$pdf->Cell(75, 10, '', 0,0);
$pdf->Cell(20, 10, 'CONTROL DE TRABAJO DE LECTURA DE MEDIDORES  ', 0,1);
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(90, 8, '', 0);
$pdf->Cell(20, 10, '"LIBRO DIARIO DE LECTURA"', 0);
$pdf->Ln(10);
$pdf->Cell(100, 8, '', 0);
$pdf->Cell(40, 8, 'FECHA: '.$verDesde, 0);
$pdf->Ln(13);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 7, 'N', 1);
$pdf->Cell(15, 7, 'CODIGO', 1);
$pdf->Cell(40, 7, 'NOMBRE', 1);
$pdf->Cell(35, 7, 'APELLIDO', 1);
$pdf->Cell(15, 7, 'GRUPO', 1);
$pdf->Cell(15, 7, 'AGENCIA', 1);
$pdf->Cell(15, 7, 'SECTOR', 1);
$pdf->Cell(15, 7, 'RUTA', 1);
$pdf->Cell(25, 7, 'HERRAMIENTAS', 1);
$pdf->Cell(40, 7, 'OBSERVACION', 1);
$pdf->Cell(25, 7, 'RECIBIDO', 1);
$pdf->Cell(25, 7, 'ENTREGADO', 1);

$pdf->Ln(7);

//CONSULTA
$productos = mysql_query("SELECT * from asignacion, ruta,  grupo, lectoravisador, sector WHERE  ar_codigolec=codiglector and ar_grupo=id_grupo  and ar_id_sector=id and ar_nruta=Rid and   fecha_asig BETWEEN '$desde' AND '$hasta' and codiglector!=0000 ORDER BY fecha_asig desc");
$item = 0;
$totaluni = 0;
$totaldis = 0;
while($productos2 = mysql_fetch_array($productos)){
	$item = $item+1;
	$pdf->Cell(10, 6, $item, 1);
	$pdf->Cell(15, 6,$productos2['codiglector'], 1);
	$pdf->Cell(40, 6, $productos2['nombre'], 1);
	$pdf->Cell(35, 6, $productos2['apellido'], 1);
	$pdf->Cell(15, 6, $productos2['ar_grupo'], 1);
	$pdf->Cell(15, 6, $productos2['g_id_agencia'], 1);
	$pdf->Cell(15, 6, $productos2['id_sector'], 1);
	$pdf->Cell(15, 6, $productos2['n_ruta'], 1);
	$pdf->Cell(25, 6, $productos2['herramienta'], 1);
	$pdf->Cell(40, 6, $productos2['ar_observacionasig'], 1);
	$pdf->Cell(25, 6, '.', 1);
	$pdf->Cell(25, 6, '.', 1);
	
	$pdf->Ln(6);
}

$productos1 = mysql_query("SELECT * from lectoravisador, ausencia WHERE  au_codigo_lector=codiglector and  activ=0  and fechaor BETWEEN '$desde' AND '$hasta'  ORDER BY fechaor desc");
	$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(104,8,'',0,1);
$pdf->Cell(31,8,'PERSONAL AUSENTE',0,1);
$pdf->Ln(2);
if($productos1){
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 7, 'N', 1);
$pdf->Cell(15, 7, 'CODIGO', 1);
$pdf->Cell(40, 7, 'NOMBRE', 1);
$pdf->Cell(35, 7, 'APELLIDO', 1);
$pdf->Cell(35, 7, 'AUSENCIA', 1);

$pdf->Ln(7);

//CONSULTA
if($productos1){

$item = 0;
$totaluni = 0;
$totaldis = 0;
while($productos22 = mysql_fetch_array($productos1)){
	$item = $item+1;
	$pdf->Cell(10, 7, $item, 1);
	$pdf->Cell(15, 7,$productos22['codiglector'], 1);
	$pdf->Cell(40, 7, $productos22['nombre'], 1);
	$pdf->Cell(35, 7, $productos22['apellido'], 1);
	$pdf->Cell(35, 7, $productos22['motivo'], 1);
	$pdf->Ln(7);
}
}
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(104,8,'',0,1);
$pdf->Cell(31,8,'Oscar Ernesto Romero Campos',0,1);
$pdf->Cell(50,8,'Auxiliar de Lectura y Aviso ',0,0);
$pdf->Cell(150, 10, 'Hoy: '.date('d-m-Y').'', 0,1);
}
$pdf->Output('ReporteDeAsignacion'.date('d-m-Y').'.pdf','D');
?>