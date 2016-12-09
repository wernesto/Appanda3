<!DOCTYPE HTML>
<html>
<?php
include('php/conexion.php');
if($_POST){

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

if($desde<=$hasta){

    $sumaandalec = mysql_query("SELECT SUM(total_usuarios) from ruta,asignacion where ar_nruta=Rid and herramienta= 'ANDALEC' and  fecha_asig BETWEEN '$desde' AND '$hasta' ORDER BY fecha_asig desc") or die ("error".mysql_error());
    $sumahandheld = mysql_query("SELECT SUM(total_usuarios) from ruta,asignacion where ar_nruta=Rid and herramienta='HANDHELD' and  fecha_asig BETWEEN '$desde' AND '$hasta' ORDER BY fecha_asig desc ") or die ("error".mysql_error());
    $sumapromedio = mysql_query("SELECT SUM(total_usuarios) from ruta,asignacion where ar_nruta=Rid and herramienta='PROMEDIO' and  fecha_asig BETWEEN '$desde' AND '$hasta' ORDER BY fecha_asig desc ") or die ("error".mysql_error());
    $TotalRutaAndalec= mysql_query("SELECT count(Rid) from ruta,asignacion where ar_nruta=Rid and herramienta= 'ANDALEC' and  fecha_asig BETWEEN '$desde' AND '$hasta' ORDER BY fecha_asig desc") or die ("error".mysql_error());
    $TotalRutaHandheld= mysql_query("SELECT count(Rid) from ruta,asignacion where ar_nruta=Rid and herramienta='HANDHELD' and  fecha_asig BETWEEN '$desde' AND '$hasta' ORDER BY fecha_asig desc ") or die ("error".mysql_error());
    $TotalRutaPromedio=mysql_query("SELECT count(Rid) from ruta,asignacion where ar_nruta=Rid and herramienta='PROMEDIO' and  fecha_asig BETWEEN '$desde' AND '$hasta' ORDER BY fecha_asig desc ") or die ("error".mysql_error());
    $res = mysql_fetch_array($sumaandalec);
    $res2 = mysql_fetch_array($sumahandheld);
    $res3 = mysql_fetch_array($sumapromedio);
    $res4 = mysql_fetch_array($TotalRutaAndalec);
    $res5 = mysql_fetch_array($TotalRutaHandheld);
    $res6 = mysql_fetch_array($TotalRutaPromedio);
   
?>


	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Grafica de Barras</title>
        <style>
        div {
            background-color: #ffffff;
            text-align: center;color:#000000;
            font-family: sans-serif;
        }
        </style>
		<script src="JQUERY/jquery-1.11.1.min.js" type='text/javascript' ></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'TABLA DE LECTURA DESDE:<?php echo $desde;?> HASTA:<?php echo $hasta;?>'
        },
        subtitle: {
            text: 'GRAFICA DE DATOS DE LECTURA CON HANDHEL, ANDALEC, PROMEDIO'
        },
        xAxis: {
            categories: [
              'TOTAL DE USUARIOS'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'DATOS'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} USUARIOS</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'ANDALEC',
            data: [<?php if($res[0]>0)
                            {echo $res[0];
                            }
                          else{
                            echo 0.0;
                          }?>]

        }, {
            name: 'HANDHELD',
            data: [<?php if($res2[0]>0)
                            {echo $res2[0];
                            }
                          else{
                            echo 0.0;
                          }?>]

        }, {
            name: 'PROMEDIO',
            data: [<?php if($res3[0]>0)
                            {echo $res3[0];
                            }
                          else{
                            echo 0.0;
                          }?>]

       

        }]
    });
});
		</script>
	</head>
	<body>
<script src="GRAFICA/js/highcharts.js"></script>
<script src="GRAFICA/js/modules/exporting.js"></script>

<section>
        <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        <b>
        <div style=""><center><h5>TOTALES DE USUARIOS CON ANDALEC,HANDHELD Y PROMEDIOS</h5></center></div>
        <div style=""><center>ANDALEC: <?php if($res[0]){echo $res[0];} else{echo 0;} ?> </center></div>
        <div><center> HANDHELD: <?php if($res2[0]){echo $res2[0];} else{echo 0;}?></center></div>
        <div><center> PROMEDIO: <?php if($res3[0]){echo $res3[0];} else{echo 0;}?></center></div>
        <div><center>TOTAL DE USUARIOS: <?php echo $total=$res[0]+$res2[0]+$res3[0]?></center></div>
        <hr>
         <div style=""><center><h5>TOTALES DE RUTAS LEIDOS CON ANDALEC,HANDHELD Y PROMEDIOS</h5></center></div>
        <div><center>TOTAL ANDALEC LEIDOS: <?php echo $res4[0]?></center></div>
        <div><center>TOTAL ANDALEC PROMEDIADOS : <?php echo $res6[0]?></center></div>
        <div><center>TOTAL ANDALEC LEIDOS CON HANDHELD: <?php echo $res5[0]?></center></div>
        <div><center>TOTAL ANDALEC: <?php echo $res4[0]+$res5[0]+$res6[0]?></center></div>
        <br><center><textarea></textarea></center>
        </b>
        <hr size="2px" color="black" /><br><br>
         <h4>F______________________________________.</h4><br>
         <h4>NOMBRE:</h4><br>
</section>
<footer><center>>Mayor informacion oscar.romero@anda.gob.sv sistema APPANDA v3.0 derechos reservados © wernesto66<</center></footer>
    </body>
</html>
<?php 
}
else{
    echo "<script>alert('ERROR!!!! (Desde) debe ser manor que (Hasta)')</script>";
                              echo"<script>
                 
                              setTimeout(location.href='http://localhost:8080/APPANDA3/buscargrafica.php',300);
                 
                             </script>    ";
                            }

} ?>
