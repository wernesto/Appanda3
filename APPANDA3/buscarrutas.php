
<!DOCTYPE html>
<?php
include 'CLASS/conexion.class.php';
include 'CLASS/grupo.class.php';
include 'CLASS/asigrutas.class.php';
include 'CLASS/lector.class.php';
include 'CLASS/sector.class.php';
include 'CLASS/ruta.class.php';

?>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Catalogo de Rutas</title>
    <link href="js/estilo.css" rel="stylesheet">
  
    <script src="JQUERY/jquery-1.11.1.min.js" type='text/javascript' ></script>
    <script type='text/javascript' src='JQUERY/menu_jquery.js'></script>
    <script src="js/jquery.js"></script>
    <script src="js/myjava.js"></script>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">   
    <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet"> 
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    
        <script src="JQUERY/jquery-1.9.1.js" type="text/javascript"></script>
    
</head>

<body>

<div align="center">
	<img src="imagen/logo.jpg" />
</div>
<div id="menus" class"menus">
<?php 
include 'indes.php'; 
 ?>
</div>
<br>
      <br>
            <center>
<div>
   
    
        <ul>
    <li>
         <h2>Reporte de Catalogo de Rutas</h2>
         
    </li>
    </ul>
</div>
</center>
<section>
    <table border="0" align="center">
        <tr>
            <td width="200"><a target="_blank" href="javascript:reportePDFruta();" class="btn btn-danger">Exportar a PDF</a></td>
        </tr>

    </table>
    
    </section>
    <br>
    <center>
     <div id="tabla"  class="registros">

<?php

    echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="200">AGENCIA</th>
                <th width="300">GRUPO</th>
                <th width="200">SECTOR</th>
                <th width="200">RUTA</th>
                <th width="200">TOTAL USUARIOS</th>
            </tr>';
$prov1 = new  Ruta() or die(mysql_error());
                        $rows4=$prov1->getcondiario2();
                        foreach ($rows4 as $row4){
                            echo "<tr>";
                             echo "<td>".$row4->id_agencia."</td>";
                            echo "<td>".$row4->id_grupo."</td>";
                            echo "<td>".$row4->id_sector."</td>";
                             echo "<td>".$row4->n_ruta."</td>";
                            echo "<td>".$row4->total_usuarios."</td>";
                            echo "</tr>";
    }

?>

</div>
</center>     


</body>
</html>