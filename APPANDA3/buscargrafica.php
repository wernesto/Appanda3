
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
    <title>Reporte de Grafica de Pastel</title>
    <link href="js/estilo.css" rel="stylesheet">

    <script src="JQUERY/jquery-1.11.1.min.js" type='text/javascript' ></script>
    <script type='text/javascript' src='JQUERY/menu_jquery.js'></script>
    <script src="js/jquery.js"></script>
    <script src="js/myjavagrafica.js"></script>
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
         <h2>Reporte de Grafica de Pastel</h2>
         
    </li>
    </ul>
</div>
</center>
<form  data-toggle="validator" action="graficaphp.php" method="post" >
<section>
    <table border="0" align="center">
        <tr>
            <td>Desde&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><input type="date" class="form-control" id="bd-desde" name="desde" required/></td>
            <td>Hasta&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><input type="date" class="form-control"  id="bd-hasta" name="hasta" required/></td>
            <td width="200"><button class="btn btn-danger" >.:GRAFICA:.</button></td>
          
        </tr>
    </table>
    </section>
    
      <center>
      
     </center>
</form>

</body>
</html>