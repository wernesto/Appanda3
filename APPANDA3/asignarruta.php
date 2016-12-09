
<!DOCTYPE html>
<?php
include 'CLASS/conexion.class.php';
include 'CLASS/grupo.class.php';
include 'CLASS/asigrutas.class.php';
include 'CLASS/lector.class.php';
include 'CLASS/sector.class.php';
include 'CLASS/ruta.class.php';
$le= new Grupo();
$rows2 = $le->getall();
$ag = new lectorAvisador();
$rows = $ag->getall();
 $hoy = date("Y-m-d");
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Asignacion de Rutas</title>
    <link rel="stylesheet" media="screen" href="css/stylerutas.css" >
    <link href="js/estilo.css" rel="stylesheet">
    <link rel="stylesheet"  href="select2/select2/select2.css">
    <script src="JQUERY/jquery-1.11.1.min.js" type='text/javascript' ></script>
    <script type='text/javascript' src='JQUERY/menu_jquery.js'></script>
    <script src="js/jquery.js"></script>
    <script src="js/myjava.js"></script>
    <script src="JQUERY/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="select2/select2/select2.js"></script>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">   
    <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet"> 
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    
        <script type="text/javascript">
        $(document).ready(function() {
         $(".js-example-basic-single").select2();
        });
    </script>
      
    
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
<div id="box1" class="box">
	<form class="contact_form" action="http://localhost:8080/APPANDA3/asignarruta2.php"  method="get" name="contact_form" >
	
		<ul>
    <li>
         <h2>Asignacion de Rutas</h2>
         <span class="required_notification">*Elije un grupo para asignar Adndalec,HandHeld,Promedio</span>
    </li>
    
<li>
<CENTER>
    <label for="grupo">Grupo:</label>
    <select id="e18"  name="grupo" class="js-example-basic-single" autofocus  required >
        <option>Elije una opcion</option>
        <?php
                foreach ($rows2 as $row2){
                
                    echo "<option value='".$row2->id_grupo."'>"
                                           .$row2->id_grupo
                          ."</option>";
                }
            ?>
    </select>
    </CENTER>
</li>
<li>
<center>
    <button class="submit" type="submit"><EM>ENVIAR</EM></button>
    <button class="submit1" type="reset" >LIMPIAR</button> 
 </center>   
</li>
</ul>
</form>
</body>
</html>