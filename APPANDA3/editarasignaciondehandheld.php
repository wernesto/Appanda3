<?php
require ("funciones.php");
seguridad();
?>
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
    <title>Edirtar Asignacion de HandHeld</title>
    <link rel="stylesheet" media="screen" href="css/stylerutas.css" >
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
    <script src="JQUERY/jquery.maskedinput.min.js" type="text/javascript"></script>
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
<?php
        
            if($_GET):
                $con = new Handheld($_GET['id']) or die(mysql_error());
                
                        $res = $con->getcondiario() or die(mysql_error());
                        foreach ($res as $row3){
                        
                            ?>
	<form class="contact_form" action=""  method="post" name="contact_form">
	
		<ul>
    <li>
         <h2>Editar Asignacion de HANDHELD</h2>
         <span class="required_notification">* Editar Asignacion de HandHeld al Lector</span>
    </li>
    <li>
        <label for="name">Lector:</label>
        <select type="text" name="nombre" required />
            <option value="<?=$row3->codiglector?>"><?=$row3->nombre?></option>
            <?php
                foreach ($rows as $row){
                    echo "<option value='".$row->codiglector."'>"
                                           .$row->nombre. " ".$row->apellido 

                          ."</option>";
                }
            ?>
            
        </select>
    
    <label for="fechaini">Fecha:</label>
    <input type="date" id="fecha" name="fecha" value="<?=$row3->HHfecha_origen?>" required />
    
</li>

<li>
    <label for="grupo">N° de Equipo</label>
    <input id="e18" type="text" name="equipo" value="<?=$row3->n_de_equipo?>" required />
       
    <label for="sector">N° de Impresora:</label>
    <input id="e17" type="text"  name="impresora" value="<?=$row3->n_de_impresora?>"  required />
    
</li>
<li>
</li>
<li>
    <label for="message">Descripcion:</label>
    <textarea name="message" cols="40" rows="6" required><?=$row3->ASdescripcion?></textarea>
</li>
<li>
    <button class="submit" type="submit">GUARDAR</button>
    <button class="submit1" type="reset" >LIMPIAR</button> 
    
</li>
</ul>
</form>
 <?php
                        }
                        
                 
                endif;
           
            ?>

</div>
<div id="tabla" class="tabla">


</div>
<?php
   
    if($_POST){
        try { 
    $ag1 = new Handheld($_POST['nombre'],$_POST['equipo'],$_POST['impresora'],$_POST['message'],$_POST['fecha'],$_GET['id'])or die(mysql_error());
    $res = $ag1->update() or die(mysql_error());
        if($res){
        echo "<script>alert('Actualizacion con Exitor')</script>";
         echo "<script> setTimeout(location.href='http://localhost:8080/APPANDA3/asignaciondehandheld',300);</script>";
        }
        } catch (Exception $e) {
        echo "<script>alert('Error! al Actualizar')</script>";  
        }   
        }
    ?>
</body>

</html>