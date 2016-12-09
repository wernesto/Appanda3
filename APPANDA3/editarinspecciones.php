<!DOCTYPE html>
<?php
include 'CLASS/conexion.class.php';
include 'CLASS/grupo.class.php';
include 'CLASS/lector.class.php';
include 'CLASS/sector.class.php';
include 'CLASS/ruta.class.php';
include 'CLASS/inspecciones.class.php';
$le= new Grupo();
$rows2 = $le->getall();
$ag = new lectorAvisador();
$rows = $ag->getall();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Asig. de Inspecciones</title>
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
    <script>
            $(document).ready(function(){
                $("#e18").change(function(){
                if($(this).val()=="none")return false;
                
                $.getJSON("http://localhost:8080/APPANDA3/sectorjson.php?id="+$(this).val())
                .done(function(data){

                        var $html="<option>Elija una opcion</option>";
                        $.each(data, function(index, value){
                                $html +="<option value='"+value.id+"'> "+value.id_sector
                                +"</option>";

                        });
                        if($html=="")$html="<option>No hay datos</option>";
                        $("#e17").html($html);
                        $("#e17").change(function(){
                           if($(this).val()=="none")return false;
                
                $.getJSON("http://localhost:8080/APPANDA3/rutajson.php?id="+$(this).val())
                .done(function(data){

                        var $html="<option>Elija una opcion</option>";
                        $.each(data, function(index, value){
                                $html +="<option value='"+value.Rid+"'> "+value.n_ruta
                                +"</option>";

                        });
                        if($html=="")$html="<option>No hay datos</option>";
                        $("#e15").html($html);
                                });
                        });
                })
                .fail(function(jqxhr, textStatus, error){
                        var err= textStatus +" , "+ error;
                        alert("Resquest Failed: "+ err);
                        });
                });
            });
            
        </script>
        <script type="text/javascript">
        jQuery(function($){
            // Definimos las mascaras para cada input
            $("#e16").mask("9999");    
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
                $con = new Inspecciones($_GET['id']) or die(mysql_error());
                
                        $res = $con->getcondiario2() or die(mysql_error());
                        foreach ($res as $row3){
                        
                            ?>
	<form class="contact_form" action=""  method="post" name="contact_form">
	
		<ul>
    <li>
         <h2>Editar Asignacion de Inspecciones</h2>
         <span class="required_notification">* Editar Asignacion de Ispecciones</span>
    </li>
    <li>
        <label for="name">Lector:</label>
        <select type="text" name="nombre" required class="js-example-basic-single">
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
    <input type="date" id="fecha" value="<?=$row3->in_fechaOrigen?>" name="fecha" required />
    
</li>

<li>
    <label for="grupo">Grupo:</label>
    <select id="e18"  name="grupo"  required class="js-example-basic-single">
        <option value="<?=$row3->id_grupo?>"><?=$row3->id_grupo?></option>
        <?php
                foreach ($rows2 as $row2){
                
                    echo "<option value='".$row2->id_grupo."'>"
                                           .$row2->id_grupo
                          ."</option>";
                }
            ?>
    </select>
    <label for="sector">Sector:</label>
    <select id="e17"  name="sector"   required class="js-example-basic-single">
      <option value="<?=$row3->id?>"> <?=$row3->id_sector?>   </option>
    </select>
</li>
<li>
   
   
    
    <label for="ruta">Ruta:</label>
    <select id="e15"  name="ruta"  required class="js-example-basic-single">
      <option value="<?=$row3->Rid?>"><?=$row3->n_ruta?></option>
    </select>
    
    <label for="secuencia">Secuencia:</label>
    <input id="e16" type="text"  name="secuencia" value="<?=$row3->in_secuencia?>" required />

</li>




<li>
    <label for="message">Secuencia y Descripcion:</label>
    <textarea name="message" cols="40" rows="6" required><?=$row3->in_descripcion?></textarea>
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
            
        
            $hoy=date('y-m-d');
            
              $ag1 = new Inspecciones($_POST['nombre'],$_POST['sector'],$_POST['ruta'],$_POST['secuencia'],$_POST['message'],$_POST['fecha'],$hoy,$_POST['grupo'],$_GET['id'])or die(mysql_error());
              $res = $ag1->update() or die(mysql_error());
        
            echo "<script>alert('Actualizacion  con Exito')</script>";
        } catch (Exception $e) {
            echo "<script>alert('Error!!! de Almacenamiento')</script>";
        }
       
        }
    ?>
</body>

</html>