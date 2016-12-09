
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
    <title>Cobros Especiales</title>
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
	<form class="contact_form" action=""  method="post" name="contact_form">
	
		<ul>
    <li>
         <h2>Asignacion de Cobros Especiales</h2>
         <span class="required_notification">*Asignacion de Cobros  Especiales al Lector</span>
    </li>
    <li>
        <label for="name">Lector:</label>
        <select type="text" name="nombre" required class="js-example-basic-single">
            <option >Selecciona un Nombre</option>
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
    <label for="grupo">N° de Referencia</label>
    <input id="e18" type="text" name="referencia"  required />
       
   
    
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
                <th width="300">NOMBRE</th>
                <th width="200">REFERENCIA</th>
                <th width="150">FECHA</th>
                <th width="150">OBSERVACION</th>
                <th width="50">OPCION</th>
            </tr>';
$prov1 = new  Cobro() or die(mysql_error());
                        $rows4=$prov1->getbuscardiario();
                        foreach ($rows4 as $row4){
                            echo "<tr>";
                            echo "<td>".$row4->nombre."</td>";
                            echo "<td>".$row4->n_cuenta_c."</td>"; 
                            echo "<td>".$row4->fecha_asig."</td>";                         
                            echo "<td>".$row4->c_descripcion."</td>";
                            echo '<td><a href="editarcobrosespeciales.php?id='.$row4->cobrID.';" class="glyphicon glyphicon-edit"></a> <a href=".../eliminardatos/eliminarCE.php?id='.$row4->cobrID.';" class="glyphicon glyphicon-remove-circle"></a></td>';
                            echo "</tr>";
    }

?>
</div>
<?php
    $hoy = date("Y-m-d");
    if($_POST){
        try {
            
        
    $ag1 = new Cobro($_POST['nombre'],$_POST['referencia'],$_POST['fecha'],$hoy,$_POST['message'],null)or die(mysql_error());
    $res = $ag1->add() or die(mysql_error());
        if($res){
           echo "<script>alert('Guardado con Exito')</script>";
             echo"<script>
                 
                setTimeout(location.href='http://localhost:8080/APPANDA3/cobrosespeciales.php',300);
                 
        </script>    ";
        }
        } catch (Exception $e) {
            echo "<script>alert('Error! al Guardar Faltan datos o Mala Asignacion')</script>";
        }   
        }
    ?>
</body>

</html>