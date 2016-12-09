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
 $hoy = date("Y-m-d");
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Asig. de Inspecciones</title>
     <link rel="stylesheet" media="screen" href="css/style.css" >
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
	<form class="contact_form" action=""  method="post" name="contact_form">
	
		<ul>
    <li>
         <h2>Asignacion de Inspecciones</h2>
         <span class="required_notification">*Asignacion de Ispecciones</span>
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
    <input type="date" id="fecha" name="fecha" value="<?php echo $hoy?>" required />
    
</li>

<li>
    <label for="grupo">Grupo:</label>
    <select id="e18"  name="grupo"  required class="js-example-basic-single">
        <option>Elije una opcion</option>
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
    </select>
</li>
<li>
   
   
    
    <label for="ruta">Ruta:</label>
    <select id="e15"  name="ruta"  required class="js-example-basic-single">
   
    </select>
    
    <label for="secuencia">Secuencia:</label>
    <input id="e16" type="text"  name="secuencia"  required />

</li>

<li>
   
   
    
    <label for="ruta">Lectura Lector:</label>
     <input id="e16" type="text"  name="leclector"  required />
   
   
    
    <label for="secuencia">Lectura Inspector:</label>
    <input id="e16" type="text"  name="lecinspector"  required />

</li>


<li>
    <label for="message">Descripcion:</label>
    <textarea name="message" cols="1" rows="1" required></textarea>
    <label for="ruta">Observacion</label>
    <select id="e15"  name="obsev"  required class="js-example-basic-single">
   <option>Existe Error del Lector</option>
   <option>Mal Promedio</option>
   <option>Existe Error del Digitador</option>
    </select>
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
                <th width="200">GRUPO</th>
                <th width="150">SECTOR</th>
                <th width="150">RUTA</th>
                <th width="150">SECUENCIA</th>
                <th width="150">LECTURA LEC.</th>
                <th width="150">LECTURA INSP.</th>
                <th width="150">OBSERVACION</th>
                <th width="150">DESCRIPCION</th>
                <th width="150">FECHA</th>
                <th width="50">OPCION</th>
            </tr>';
$prov1 = new Inspecciones() or die(mysql_error());
                        $rows4=$prov1->getcondiario();
                                      
                        
                        foreach ($rows4 as $row4){
                            echo "<tr>";
                            echo "<td>".$row4->nombre."</td>";
                            echo "<td>".$row4->in_grupo."</td>";
                            echo "<td>".$row4->id_sector."</td>";
                            echo "<td>".$row4->n_ruta."</td>";
                            echo "<td>".$row4->in_secuencia."</td>";
                            echo "<td>".$row4->leclector."</td>";
                            echo "<td>".$row4->lecinspector."</td>";
                            echo "<td>".$row4->obsev."</td>";
                            echo "<td>".$row4->in_descripcion."</td>";
                            echo "<td>".$row4->in_fechaOrigen."</td>";

                            echo '<td><a href="editarinspecciones.php?id='.$row4->idINSP.';" class="glyphicon glyphicon-edit"></a> <a href="eliminarinspecciones.php?id='.$row4->idINSP.';" class="glyphicon glyphicon-remove-circle"></a></td>';
                            echo "</tr>";
    }

?>
</div>
<?php
    $hoy = date("Y-m-d");
    if($_POST){
       // try {
            
        
    $ag1 = new Inspecciones($_POST['nombre'],$_POST['sector'],$_POST['ruta'],$_POST['secuencia'],$_POST['message'],$_POST['fecha'],$hoy,$_POST['grupo'],null,$_POST['leclector'],$_POST['lecinspector'],$_POST['obsev'])or die(mysql_error());
    $res = $ag1->add() or die(mysql_error());
        if($res){
           echo "<script>alert('Guardado con Exito')</script>";
             echo"<script>
                 
                setTimeout(location.href='http://localhost:8080/APPANDA3/inspecciones.php',300);
                 
        </script>    ";

        }
        //} catch (Exception $e) {
            echo "<script>alert('Error! al Guardar Faltan datos o mala Asignacion')</script>";
        //}   
        }
    ?>
</body>

</html>