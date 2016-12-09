
<!DOCTYPE html>
<?php
include 'CLASS/conexion.class.php';
include 'CLASS/agencia.class.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Crear Agencia</title>
    <link rel="stylesheet" media="screen" href="css/stylerutas.css" >
    <link href="js/estilo.css" rel="stylesheet">
    <script src="JQUERY/jquery-1.11.1.min.js" type='text/javascript' ></script>
    <script type='text/javascript' src='JQUERY/menu_jquery.js'></script>
    <script src="js/jquery.js"></script>
    <script src="js/myjava.js"></script>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">   
    <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet"> 
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet"  href="select2/select2/select2.css">
    <script src="JQUERY/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="select2/select2/select2.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="JQUERY/jquery.maskedinput.min.js" type="text/javascript"></script>
     <script type="text/javascript">
        $(document).ready(function() {
         $(".js-example-basic-single").select2();
        });
    </script>
     <script type="text/javascript">
        jQuery(function($){
            // Definimos las mascaras para cada input
            $("#e18").mask("999");
            $("#e17").mask("999");
           
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
         <h2>Crear Agencia</h2>
         <span class="required_notification">*Creacion de Agencias</span>
    </li>
    <li>
        <label for="name">Lugar:</label>
        <select type="text" name="lugar" required class="js-example-basic-single">
            <option>Oriente</option>
            
        </select>
    
    <label for="grupo">N° de Agencia</label>
    <input id="e18" type="text" name="agencia"  required />
    
</li>



<li>
    <button class="submit" type="submit">GUARDAR</button>
    <button class="submit1" type="reset" >LIMPIAR</button> 
    
</li>
</ul>
</form>

</div>
<div  class="registros">

<?php

    echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="300">LUGAR</th>
                <th width="200">N° DE AGENCIA</th>
                <th width="200">FECHA</th>
                <th width="50">OPCION</th>
            </tr>';
$prov1 = new  Agencia() or die(mysql_error());
                        $rows4=$prov1->getcondiario();
                        foreach ($rows4 as $row4){
                            echo "<tr>";
                            echo "<td>".$row4->id_agencia."</td>";
                            echo "<td>".$row4->n_de_agencia."</td>";
                             echo "<td>".$row4->Afecha."</td>";                       
                            echo '<td><a href="eliminaragencia.php?id='.$row4->id_agencia.';" class="glyphicon glyphicon-remove-circle"></a></td>';
                            echo "</tr>";
    }

?>
</div>
<?php
   $hoy = date("Y-m-d");
    if($_POST){
    try {
      
    
    $con= new Agencia($_POST['agencia'],$_POST['lugar'],$hoy) or die(mysql_error());
    $res = $con->add() or die(mysql_error());
                         if($res){
                           echo "<script>alert('Guardado con Exito')</script>";
                              echo"<script>
                 
                              setTimeout(location.href='http://localhost:8080/APPANDA3/crearagencia.php',300);
                 
                             </script>    ";
                            }

                } catch (Exception $e) {
      echo "<script>alert('Error! al Guardar ya Existe o Faltan datos')</script>";
    }
                        }
                        else{}
             
    
    ?>
</body>

</html>