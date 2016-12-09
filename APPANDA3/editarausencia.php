<?php
require ("funciones.php");
seguridad();
?>
<!DOCTYPE html>
<?php

include 'CLASS/conexion.class.php';
include 'CLASS/lector.class.php';
include 'CLASS/ausencia.class.php';
$ag = new lectorAvisador();
$rows = $ag->getall();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar AUSENCIAS</title>
    <link rel="stylesheet" media="screen" href="css/style.css" >
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">   
    <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet"> 
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="JQUERY/jquery-1.11.1.min.js" type='text/javascript' ></script>
    <script type='text/javascript' src='JQUERY/menu_jquery.js'></script>
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
                $con = new Ausencia($_GET['id']) or die(mysql_error());
                
                        $res = $con->getcondiario() or die(mysql_error());
                        foreach ($res as $row3){
                        
                            ?>

	<form class="contact_form" action=""  method="post" name="contact_form" >
	
		<ul>
    <li>
         <h2>Editar AUSENCIA</h2>
         <span class="required_notification">* Editar Incapacidad,Permisos,Vacaciones</span>
    </li>
    <li>
        <label for="name">Lector:</label>
        <select type="text" name="nombre" required />
            <option value="<?=$row3->codiglector?>"><?=$row3->nombre?></option>
            <?php
                foreach ($rows as $row){
                    echo "<option value='".$row->codiglector."'>"
                                           .$row->nombre." " .$row->apellido

                          ."</option>";
                }
            ?>
            
        </select>
    
    <label for="fechaini">Fecha Inicio</label>
    <input type="date" value="<?=$row3->fechainicio?>" name="fechaini"required />
    
</li>

<li>
    <label for="fechafin">Fecha Fin:</label>
    <input type="date" value="<?=$row3->fechafin?>" name="fechafin"required />
    

    <label for="tipo">Tipo de Ausencia:</label>
    <select type="text" name="tipo"required />
     <option><?=$row3->motivo?></option>
     <option>Incapacidad</option>
    <option>Permiso Personal</option>
    <option>No se Presento</option>
    <option>Vacaciones</option>
    </select>
</li>
<li>
    <label for="message">Descripcion:</label>
    <textarea name="message" cols="40" rows="6" required><?=$row3->descripcion?></textarea>
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

<?php
    $hoy = date("Y-m-d");
    
    
    if($_POST){

        if($_POST['fechafin'] < $_POST['fechaini']){
        echo "<script>alert('La fecha inicio es menor que la final')</script>";
    }
    else{
        try {
            
        
    $ag1 = new Ausencia($_POST['nombre'],$_POST['fechaini'],$_POST['fechafin'],$_POST['tipo'],$_POST['message'],$hoy,$_GET['id'])or die(mysql_error());
    $res = $ag1->update() or die(mysql_error());
        if($res){
            
            echo "<script>alert('Guardado con Exito')</script>";
            $ag2 = new lectorAvisador($_POST['nombre'],FALSE);
            $sa = $ag2->detivate();
            echo"<script>
                 
                setTimeout(location.href='http://localhost:8080/APPANDA3/ausencia.php',300);
                 
                </script>    ";
            }
        }
         catch (Exception $e) {
            echo "<script>alert('Error! al Guardar Faltan datos o ya existe')</script>";
    
        }
    }
}
    
    ?>
</body>
</html>