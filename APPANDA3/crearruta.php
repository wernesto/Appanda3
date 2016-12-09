
<!DOCTYPE html>
<?php
include 'CLASS/conexion.class.php';
include 'CLASS/grupo.class.php';
include 'CLASS/sector.class.php';
include 'CLASS/ruta.class.php';
$gr= new Grupo();
$rowss = $gr->getAll();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Crear Sector</title>
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
    <script >
    
    $(document).ready(function(){
                $("#e1").change(function(){
                if($(this).val()=="none")return false;
                
                $.getJSON("http://localhost:8080/APPANDA3/sectorjson.php?id="+$(this).val())
                .done(function(data){

                        var $html="<option>Elija una opcion</option>";
                        $.each(data, function(index, value){
                                $html +="<option value='"+value.id+"'> "+value.id_sector
                                +"</option>";

                        });
                        if($html=="")$html="<option>No hay MateriaPrima</option>";
                        $("#e3").html($html);
                        $("#e3").change(function(){
                            $("#actions").html(
                                    "<option value='1'>Eliminar</option><option value='2'>Modificar</optio><option value='3'>Buscar</option>"
                                );
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
            $("#e18").mask("999");
            $("#e19").mask("9999");
            $("#e20").mask("9999");
           $("#e21").mask("9999");
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
         <h2>Crear Sector</h2>
         <span class="required_notification">*Creacion de Sector</span>
    </li>
    <li>
        <label for="name">Grupo:</label>
        <select type="text" id="e1"  name="grupo" required class="js-example-basic-single" autofocus>
            <?php
                foreach ($rowss as $row){
                    echo "<option value='".$row->id_grupo."'>"
                                           .$row->id_grupo
                          ."</option>";
                }
            ?>
            
        </select>
    
    <label for="sector">Sector:</label>
    <select id="e3"  name="sector"  required class="js-example-basic-single">
    </select>
</li>
<li>
    <label for="ruta">Ruta:</label>
    <input id="e18" type="text" name="ruta"  required />
    <label for="usuarios">Total Usuarios:</label>
    <input id="e21"  type="text" name="total"  required />

</li>
<li>
    <label for="grupo">Desde:</label>
    <input id="e19" type="text" name="desde"  required />
    <label for="grupo">Hasta:</label>
    <input id="e20" type="text" name="hasta"  required />
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
                <th width="300">GRUPO</th>
                <th width="200">SECTOR</th>
                <th width="200">RUTA</th>
                <th width="200">DESDE</th>
                <th width="200">HASTA</th>
                <th width="200">TOTAL USUARIOS</th>
                <th width="200">FECHA</th>
                <th width="50">OPCION</th>
            </tr>';
$prov1 = new  Ruta() or die(mysql_error());
                        $rows4=$prov1->getcondiario();
                        foreach ($rows4 as $row4){
                            echo "<tr>";
                            echo "<td>".$row4->id_grupo."</td>";
                            echo "<td>".$row4->id_sector."</td>";
                            echo "<td>".$row4->n_ruta."</td>";
                            echo "<td>".$row4->r_desde."</td>";
                            echo "<td>".$row4->r_hasta."</td>";
                            echo "<td>".$row4->total_usuarios."</td>";
                            echo "<td>".$row4->Rfecha."</td>";                       
                            echo '<td><a href="eliminarruta.php?id='.$row4->Rid.';" class="glyphicon glyphicon-remove-circle"></a></td>';
                            echo "</tr>";
    }

?>
</div>
<?php
    $hoy = date("Y-m-d");
    if($_POST){
        try {
            
        
            $sec = new Ruta(NULL, $_POST['ruta'],$_POST['total'],$_POST['desde'],$_POST['hasta'],$_POST['sector'], $hoy)or die(mysql_error());
            $res = $sec->add() or die(mysql_error());
             if($res){
            
           echo "<script>alert('Guardado con Exito')</script>";
             echo"<script>
                 
                setTimeout(location.href='http://localhost:8080/APPANDA3/crearruta.php',300);
                 
        </script>    ";

            }else{"<script>alert('Error! al Guardar Datos ya existentes')</script>";}
        
        } catch (Exception $e) {
            echo "<script>alert('Error!! al Guardado Ruta.  Faltan datos')</script>";
        }   
        }
    
    ?>
</body>

</html>