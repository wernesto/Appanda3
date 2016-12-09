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

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Image('imagen/anda.png' , 10 ,10, 55 , 20,'PNG');
$pdf->Image('imagen/gob.png' , 150 ,10, 55 , 20,'PNG');
$pdf->Ln(20);
$pdf->Cell(35, 10, '', 0,0);
$pdf->Cell(20, 10, 'LECTURA REALIZADA CON HANDHELD, ANDALEC O PROMEDIOS', 0,1);
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(2);
$pdf->Cell(85, 7, '', 0);
$pdf->Cell(65, 7, 'FECHA: '.$verDesde, 0);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 8);


$pdf->Cell(7, 7, 'N', 1,'C');
$pdf->Cell(15, 7, 'CODIGO', 1);
$pdf->Cell(28, 7, 'NOMBRE', 1);
$pdf->Cell(33, 7, 'APELLIDO', 1);
$pdf->Cell(15, 7, 'GRUPO', 1);
$pdf->Cell(15, 7, 'AGENCIA', 1);
$pdf->Cell(15, 7, 'SECTOR', 1);
$pdf->Cell(10, 7, 'RUTA', 1);
$pdf->Cell(25, 7, 'HERRAMIENTAS', 1);
$pdf->Cell(33, 7, 'OBSERVACION', 1);


$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 8);
//CONSULTA
$productos = mysql_query("SELECT * from asignacion, ruta,  grupo, lectoravisador, sector WHERE  ar_codigolec=codiglector and ar_grupo=id_grupo  and ar_id_sector=id and ar_nruta=Rid and   fecha_asig BETWEEN '$desde' AND '$hasta' and codiglector!=0000 ORDER BY ar_grupo,id,Rid asc");
$item = 0;
$totaluni = 0;
$totaldis = 0;
while($productos2 = mysql_fetch_array($productos)){
	$item = $item+1;
	$pdf->Cell(7, 7, $item, 1);
	$pdf->Cell(15, 7,$productos2['codiglector'], 1);
	$pdf->Cell(28, 7, $productos2['nombre'], 1);
	$pdf->Cell(33, 7, $productos2['apellido'], 1);
	$pdf->Cell(15, 7, $productos2['ar_grupo'], 1);
	$pdf->Cell(15, 7, $productos2['g_id_agencia'], 1);
	$pdf->Cell(15, 7, $productos2['id_sector'], 1);
	$pdf->Cell(10, 7, $productos2['n_ruta'], 1);
	$pdf->Cell(25, 7, $productos2['herramienta'], 1);
	$pdf->Cell(33, 7, $productos2['ar_observacionasig'], 1);
	$pdf->Ln(7);
}
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(104,7,'',0,1);
$pdf->Cell(80,7,'Oscar Ernesto Romero Campos',0,0);$pdf->Cell(31,7,'RECIBIDO:_________________________________',0,1);
$pdf->Cell(80,7,'Auxiliar de Lectura y Aviso ',0,0);$pdf->Cell(31,7,'FECHA:____________________________________',0,1);

$pdf->Cell(20,8,'OBSERVACION:________________________________________________________________________________________________________',0,1);
$pdf->Cell(20,8,'_____________________________________________________________________________________________________________________',0,1);
$pdf->Cell(150, 10, 'Hoy: '.date('d-m-Y').'', 0,1);
$pdf->Cell(35,7,'Mayor informacion oscar.romero@anda.gob.sv sistema APPANDA v3.0 derechos resercados wernesto66<',0,1);
$pdf->Output('ReporteDeAsignacion'.date('d-m-Y').'.pdf','D');
?>