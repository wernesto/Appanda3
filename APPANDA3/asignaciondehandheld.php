
<!DOCTYPE html>
<?php
include 'CLASS/conexion.class.php';
include 'CLASS/hadheld.class.php';
include 'CLASS/lector.class.php';
$ag = new lectorAvisador();
$rows = $ag->getall();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Asignacion de HandHeld</title>
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
     <script type="text/javascript">
        jQuery(function($){
            // Definimos las mascaras para cada input
            $("#e18").mask("9999");
            $("#e17").mask("9999");
           
            $("#comodines").mask("?");
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
	<form class="contact_form" action=""  method="post" name="contact_form">
	
		<ul>
    <li>
         <h2>Asignacion de HANDHELD</h2>
         <span class="required_notification">*Asignacion de HandHeld al Lector</span>
    </li>
    <li>
        <label for="name">Lector:</label>
        <select type="text" name="nombre" required class="js-example-basic-single">
            <option>Selecciona un Nombre</option>
            <?php
                foreach ($rows as $row){
                    echo "<option value='".$row->codiglector."'>"
                                           .$row->nombre. " ".$row->apellido 

                          ."</option>";
                }
            ?>
            
        </select>
    
    <label for="fechaini">Fecha:</label>
    <input type="date" id="fecha" name="fecha" required />
    
</li>

<li>
    <label for="grupo">N° de Equipo</label>
    <input id="e18" type="text" name="equipo" placeholder="0000" required />
       
    <label for="sector">N° de Impresora:</label>
    <input id="e17" type="text"  name="impresora" placeholder="0000"  required />
    
</li>
<li>
</li>
<li>
    <label for="message">Descripcion:</label>
    <textarea name="message" cols="40" rows="6" required></textarea>
</li>
<li>
    <button class="submit" type="submit">GUARDAR</button>
    <button class="submit1" type="reset" >LIMPIAR</button> 
    
</li>
</ul>
</form>

</div>
<div class="registros">

<?php

    echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="300">Nombre</th>
                <th width="200">N° DE EQUIPO</th>
             
                <th width="150">N° DE IMPRESOR</th>
                <th width="150">FECHA</th>
                <th width="150">OBSERVACION</th>
                <th width="50">OPCION</th>
            </tr>';
$prov1 = new  Handheld() or die(mysql_error());
                        $rows4=$prov1->getcondiario();
                        foreach ($rows4 as $row4){
                            echo "<tr>";
                            echo "<td>".$row4->nombre."</td>";
                            echo "<td>".$row4->n_de_equipo."</td>";
                            echo "<td>".$row4->n_de_impresora."</td>";
                            echo "<td>".$row4->HHfecha_origen."</td>";                         
                            echo "<td>".$row4->ASdescripcion."</td>";
                            echo '<td><a href="editarasignaciondehandheld.php?id='.$row4->HHid.';" class="glyphicon glyphicon-edit"></a> <a href=eliminarHH.php?id='.$row4->HHid.';" class="glyphicon glyphicon-remove-circle"></a></td>';
                            echo "</tr>";
    }

?>
</div>
<?php
   
    if($_POST){
        try { 
    $ag1 = new Handheld($_POST['nombre'],$_POST['equipo'],$_POST['impresora'],$_POST['message'],$_POST['fecha'],'null')or die(mysql_error());
    $res = $ag1->add() or die(mysql_error());
        if($res){
       echo "<script>alert('Guardado con Exito')</script>";
             echo"<script>
                 
                setTimeout(location.href='http://localhost:8080/APPANDA3/asignaciondehandheld',300);
                 
        </script>    ";
        }
        } catch (Exception $e) {
        echo "<script>alert('Error! al Guardar Faltan datos o Mala Asignacion')</script>";  
        }   
        }
    ?>
</body>

</html>