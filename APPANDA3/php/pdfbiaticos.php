<?php

if(strlen($_GET['desde'])>0 and strlen($_GET['hasta'])>0 and strlen($_GET['nombre'])>0 ){
	$desde = $_GET['desde'];
	$hasta = $_GET['hasta'];
	$nombre = $_GET['nombre'];

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
$pdf->Cell(90, 8, '', 0);
$pdf->Cell(20, 10, '"CONTROL DE BIATICOS POR LECTOR"', 0);
$pdf->Ln(10);
$pdf->Cell(85, 8, '', 0);
$pdf->Cell(30, 8, 'Desde: '.$verDesde.' hasta: '.$verHasta, 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 8, 'N', 1);
$pdf->Cell(15, 8, 'CODIGO', 1);
$pdf->Cell(40, 8, 'NOMBRE', 1);
$pdf->Cell(35, 8, 'APELLIDO', 1);
$pdf->Cell(15, 8, 'GRUPO', 1);
$pdf->Cell(15, 8, 'AGENCIA', 1);
$pdf->Cell(15, 8, 'SECTOR', 1);
$pdf->Cell(15, 8, 'RUTA', 1);
$pdf->Cell(40, 8, 'OBSERVACION', 1);
$pdf->Cell(20, 8, 'FECHA', 1);


$pdf->Ln(8);

//CONSULTA
$productos = mysql_query("SELECT * from asignacion, ruta,  grupo, lectoravisador, sector WHERE  ar_codigolec=codiglector and ar_grupo=id_grupo  and ar_id_sector=id and ar_nruta=Rid  and  fecha_asig BETWEEN '$desde' AND '$hasta' and codiglector='$nombre' AND id_sector!=301 and codiglector!=0000 ORDER BY fecha_asig desc");
$item = 0;
$totaluni = 0;
$totaldis = 0;
while($productos2 = mysql_fetch_array($productos)){
	$item = $item+1;
	$pdf->Cell(10, 8, $item, 1);
	$pdf->Cell(15, 8,$productos2['codiglector'], 1);
	$pdf->Cell(40, 8, $productos2['nombre'], 1);
	$pdf->Cell(35, 8, $productos2['apellido'], 1);
	$pdf->Cell(15, 8, $productos2['ar_grupo'], 1);
	$pdf->Cell(15, 8, $productos2['g_id_agencia'], 1);
	$pdf->Cell(15, 8, $productos2['id_sector'], 1);
	$pdf->Cell(15, 8, $productos2['n_ruta'], 1);
	$pdf->Cell(40, 8, $productos2['ar_observacionasig'], 1);
	$pdf->Cell(20, 8, $productos2['fecha_asig'], 1);
	
	
	$pdf->Ln(8);
}

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(104,8,'',0,1);
$pdf->Cell(31,8,'Oscar Ernesto Romero Campos',0,1);
$pdf->Cell(50,8,'Auxiliar de Lectura y Aviso ',0,0);
$pdf->Cell(150, 10, 'Hoy: '.date('d-m-Y').'', 0,1);

$pdf->Output('reporteBiaticos'.date('d-m-Y').'.pdf','D');
?>