
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
    <link rel="stylesheet" media="screen" href="css/stylerutas1.css" >
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
	<form class="contact_form" action=""  method="post" name="contact_form" >
	
		<ul>
    <li>
         <h2>Asignacion de Rutas</h2>
         <span class="required_notification">*Asignacion con Adndalec,HandHeld,Promedio</span>
    </li>
    <li>
        <label for="name">Lector:</label>
        <select type="text" name="nombre" class="js-example-basic-single"  required >
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
    <input type="date" id="fecha" name="fecha" required value="<?php echo $hoy?>" />
    
</li>

<li>
    <label for="grupo">Grupo:</label>
    <select id="e18"  name="grupo" class="js-example-basic-single"  required >
        <option>Elije una opcion</option>
        <?php
                foreach ($rows2 as $row2){
                
                    echo "<option value='".$row2->id_grupo."'>"
                                           .$row2->id_grupo
                          ."</option>";
                }
            ?>
    </select>
    <label for="tipo">Herramienta:</label>
    <select type="text" class="js-example-basic-single" name="tipo" required >
         <option>Andalec</option>
         <option>HandHeld</option>
         <option>Promedio</option>
    </select>
</li>
<li>
    <label for="sector">Sector:</label>
    <select  id="e17"  name="sector" class="js-example-basic-single"  required >
   
    </select>
    <label for="ruta">Ruta:</label>
    <select id="e15"  name="ruta" class="js-example-basic-single" required >
   
    </select>
    

</li>




<li>
    <label for="message">Descripcion:</label>
    <textarea name="message" cols="40" rows="6" ></textarea>
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
                <th width="150">AGENCIA</th>
                <th width="150">SECTOR</th>
                <th width="150">RUTA</th>
                <th width="150">HERRAMIENTA</th>
                <th width="150">FECHA</th>
                 <th width="150">OBSERVACION</th>
                <th width="50">OPCION</th>
            </tr>';
$prov = new Asigruta() or die(mysql_error());
                        $rows=$prov->getdiario();
                        foreach ($rows as $row){
                            echo "<tr>";
                            echo "<td>".$row->nombre."</td>";
                            echo "<td>".$row->ar_grupo."</td>";
                            echo "<td>".$row->g_id_agencia."</td>";
                            echo "<td>".$row->id_sector."</td>";
                            echo "<td>".$row->n_ruta."</td>";
                            echo "<td>".$row->herramienta."</td>";
                            echo "<td>".$row->fecha_asig."</td>";
                            echo "<td>".$row->ar_observacionasig."</td>";
                            echo '<td><a href="editarasignacion.php?id='.$row->asigID.';" class="glyphicon glyphicon-edit"></a> <a href="eliminarasignacion.php?id='.$row->asigID.';" class="glyphicon glyphicon-remove-circle"></a></td>';
                            echo "</tr>";
    }

?>
</div>
<?php
    $hoy = date("Y-m-d");
    if($_POST){
        try{
    $ag1 = new Asigruta($_POST['fecha'],$_POST['tipo'],$_POST['grupo'],$_POST['sector'],$_POST['ruta'],$_POST['nombre'],$hoy,$_POST['message'],null)or die(mysql_error());
    $res = $ag1->add() or die(mysql_error());
        if($res){
           echo "<script>alert('Guardado con Exito')</script>";
             echo"<script>
                 
                setTimeout(location.href='http://localhost:8080/APPANDA3/asignarruta.php',300);
                 
        </script>    ";
        }
        }
         catch (Exception $e) {
    
            echo "<script>alert('Error! de Datos')</script>";
             echo"<script>
                 
                setTimeout(location.href='http://localhost:8080/APPANDA3/asignarruta.php',300);
                 
        </script>    ";
            
        }
        }
    ?>
</body>
</html>