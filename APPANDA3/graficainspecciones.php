<!DOCTYPE HTML>
<html>
<?php
include('php/conexion.php');
if($_POST){

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

if($desde<=$hasta){

    $sumaandalec = mysql_query("SELECT SUM(total_usuarios) from inspecciones where obsev= 'Existe Error del Lector' and  in_fecha BETWEEN '$desde' AND '$hasta' ORDER BY in_fecha desc") or die ("error".mysql_error());
    $sumahandheld = mysql_query("SELECT SUM(total_usuarios) from inspecciones where obsev='Mal Promedio' and  in_fecha BETWEEN '$desde' AND '$hasta' ORDER BY in_fecha desc ") or die ("error".mysql_error());
    $sumapromedio = mysql_query("SELECT SUM(total_usuarios) from inspecciones where obsev='Existe Error del Digitador' and  in_fecha BETWEEN '$desde' AND '$hasta' ORDER BY in_fecha desc ") or die ("error".mysql_error());
    $TotalRutaAndalec= mysql_query("SELECT count(idINSP) from inspecciones where  obsev= 'Existe Error del Lector' and  in_fecha BETWEEN '$desde' AND '$hasta' ORDER BY in_fecha desc") or die ("error".mysql_error());
    $TotalRutaHandheld= mysql_query("SELECT count(idINSP) from inspecciones where obsev='Mal Promedio' and  in_fecha BETWEEN '$desde' AND '$hasta' ORDER BY in_fecha desc ") or die ("error".mysql_error());
    $TotalRutaPromedio=mysql_query("SELECT count(idINSP) from inspecciones where obsev='Existe Error del Digitador' and  in_fecha BETWEEN '$desde' AND '$hasta' ORDER BY in_fecha desc ") or die ("error".mysql_error());
    $res = mysql_fetch_array($sumaandalec);
    $res2 = mysql_fetch_array($sumahandheld);
    $res3 = mysql_fetch_array($sumapromedio);
    $res4 = mysql_fetch_array($TotalRutaAndalec);
    $res5 = mysql_fetch_array($TotalRutaHandheld);
    $res6 = mysql_fetch_array($TotalRutaPromedio);

   
    
    
   
?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Grafica de Datos</title>
        <style>
        div {
            background-color: #ffffff;
            text-align: center;color:#000000;
            font-family: sans-serif;
        }
        #anda{
           
            max-width: 200px;
            max-height: 75px;

        }
        #gob{
           margin-left: 250px;
            max-width: 150px;
            max-height: 75px;

        }
        footer{
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
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafica de Consulta de Datos desde: <?php echo $desde?>  hasta:<?php echo $hasta ?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'ANDALEC',
                y: <?php if($res[0]>0)
                            {echo $res[0];
                            }
                          else{
                            echo 0.0;
                          }
                ?> 
            }, {
                name: 'HANDHELD',
                y: <?php if($res2[0]>0)
                            {echo $res2[0];
                            }
                          else{
                            echo 0.0;
                          }
                ?> ,
                sliced: true,
                selected: true
            }, {
                name: 'PROMEDIO',
                y:  <?php if($res3[0]>0)
                            {echo $res3[0];
                            }
                          else{
                            echo 0.0;
                          }
                ?> 
            
            }]
        }]
    });
});
		</script>
        

	</head>
	<body>
    <header>
        <img src="imagen/anda.png" id="anda">
        <img src="imagen/gob.png" id="gob">
    </header>
    <section>
        <script src="GRAFICA/js/highcharts.js"></script>
        <script src="GRAFICA/js/modules/exporting.js"></script>
    </section>
    <section>
        <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        <div style=""><center><h5><b>TOTALES DE USUARIOS CON ANDALEC,HANDHELD Y PROMEDIOS</b></h5></center></div>
        <div style=""><center><b>ANDALEC:</b> <?php if($res[0]){echo $res[0];} else{echo 0;} ?> </center></div>
        <div><center><b> HANDHELD:</b> <?php if($res2[0]){echo $res2[0];} else{echo 0;}?></center></div>
        <div><center><b> PROMEDIO: </b><?php if($res3[0]){echo $res3[0];} else{echo 0;}?></center></div>
        <div><center><b>TOTAL DE USUARIOS: </b><?php echo $total=$res[0]+$res2[0]+$res3[0]?></center></div>
        <hr>
         <div style=""><center><h5><b>TOTALES DE RUTAS LEIDOS CON ANDALEC,HANDHELD Y PROMEDIOS</b></h5></center></div>
        <div><center><b>TOTAL ANDALEC LEIDOS: </b><?php echo $res4[0]?></center></div>
        <div><center><b>TOTAL ANDALEC PROMEDIADOS : </b><?php echo $res6[0]?></center></div>
        <div><center><b>TOTAL ANDALEC LEIDOS CON HANDHELD: </b><?php echo $res5[0]?></center></div>
        <div><center><b>TOTAL ANDALEC: </b><?php echo $res4[0]+$res5[0]+$res6[0]?></center></center></div>
        <br><center><textarea></textarea></center>
        <hr size="2px" color="black" />
        <h4>F______________________________________.</h4>
        <h4>NOMBRE:</h4>
        <center>>Mayor informacion oscar.romero@anda.gob.sv sistema APPANDA v3.0 derechos reservados wernesto66<</center>
</section>
<footer></footer>
    </body>
</html>
<?php 
}
else{
    echo "<script>alert('ERROR!!!! (Desde) debe ser mayor que (Hasta)')</script>";
                              echo"<script>
                 
                              setTimeout(location.href='http://localhost:8080/APPANDA3/buscargrafica.php',300);
                 
                             </script>    ";
                            }

} ?>
