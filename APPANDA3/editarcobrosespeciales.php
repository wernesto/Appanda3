<?php
require ("funciones.php");
seguridad();
?>
<!DOCTYPE html>
<?php
include 'CLASS/conexion.class.php';
include 'CLASS/cobroespecial.class.php';
include 'CLASS/lector.class.php';
$ag = new lectorAvisador();
$rows = $ag->getall();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Cobros Especiales</title>
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
            $("#e18").mask("99-999-99-9999");
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
                $con = new Cobro($_GET['id']) or die(mysql_error());
                
                        $res = $con->getbuscardiario2() or die(mysql_error());
                        foreach ($res as $row3){
                        
                            ?>
	<form class="contact_form" action=""  method="post" name="contact_form">
	
		<ul>
    <li>
         <h2>Editar Asignacion de Cobros Especiales</h2>
         <span class="required_notification">*Edita Asignacion de Cobros  Especiales al Lector</span>
    </li>
    <li>
        <label for="name">Lector:</label>
        <select type="text" name="nombre" required class="js-example-basic-single">
            <option value="<?=$row3->codiglector?>" ><?=$row3->nombre?></option>
            <?php
                foreach ($rows as $row){
                    echo "<option value='".$row->codiglector."'>"
                                           .$row->nombre. " ".$row->apellido 

                          ."</option>";
                }
            ?>
            
        </select>
    
    <label for="fechaini">Fecha:</label>
    <input type="date" id="fecha" name="fecha" value="<?=$row3->fecha_asig?>" required />
    
</li>

<li>
    <label for="grupo">N° de Referencia</label>
    <input id="e18" type="text" name="referencia" value="<?=$row3->n_cuenta_c?>"  required />
       
   
    
</li>
<li>
</li>
<li>
    <label for="message">Descripcion:</label>
    <textarea name="message" cols="40" rows="6"  required><?=$row3->c_descripcion?></textarea>
</li>
<li>
    <button class="submit" type="submit">GUARDAR</button>
    <button class="submit1" type="reset" >LIMPIAR</button> 
    
</li>
</ul>
</form>

</div>
<div id="tabla" class="tabla">

 <?php
                        }
                        
                 
                endif;
           
            ?>
</div>
<?php
    
    if($_POST){
       
       try {
            
        
     $hoy = date("Y-m-d"); 
    $ag1 = new Cobro($_POST['nombre'],$_POST['referencia'],$_POST['fecha'],$hoy,$_POST['message'],$_GET['id'])or die(mysql_error());
    $res = $ag1->update() or die(mysql_error());
        if($res){
            echo "<script>alert('Guardado con Exito')</script>";
            echo"<script>
                 
                setTimeout(location.href='http://localhost:8080/APPANDA3/cobrosespeciales.php',300);
                 
        </script>    ";
        }
        else{ echo "<script>alert('Error! al Guardar DATOS ERRONEOS O YA EXISTENTES')</script>";}
        
         } catch (Exception $e) {
            echo "<script>alert('Error! FALTAN DATOS')</script>";
            
        }   
        
        }

    ?>
</body>

</html>