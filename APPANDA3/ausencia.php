
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
    <title>AUSENCIAS</title>
    <link rel="stylesheet" media="screen" href="css/style.css" >
    <link href="js/estilo.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">   
    <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet"> 
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet"  href="select2/select2/select2.css">
    <script src="JQUERY/jquery-1.9.1.js" type="text/javascript"></script>
     <script src="JQUERY/jquery-1.11.1.min.js" type='text/javascript' ></script>
    <script src="select2/select2/select2.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
   
    <script type='text/javascript' src='JQUERY/menu_jquery.js'></script>
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
         <h2>AUSENCIA</h2>
         <span class="required_notification">* Incapacidad,Permisos,Vacaciones</span>
    </li>
    <li>
        <label for="name">Lector:</label>
        <select type="text" name="nombre" required class="js-example-basic-single" >
            <option>Selecciona un Nombre</option>
            <?php
                foreach ($rows as $row){
                    echo "<option value='".$row->codiglector."'>"
                                           .$row->nombre." " .$row->apellido

                          ."</option>";
                }
            ?>
            
        </select>
    
    <label for="fechaini">Fecha Inicio</label>
    <input type="date" name="fechaini"required />
    
</li>

<li>
    <label for="fechafin">Fecha Fin:</label>
    <input type="date" name="fechafin"required />
    

    <label for="tipo">Tipo de Ausencia:</label>
    <select type="text" name="tipo"required class="js-example-basic-single" >
     <option>Incapacidad</option>
    <option>Permiso Personal</option>
    <option>No se Presento</option>
    <option>Vacaciones</option>
    </select>
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
                <th width="200">FECHA INICIO</th>
                <th width="150">FECHA FINAL</th>
                <th width="150">TIPO</th>
                <th width="150">FECHA DE INGRESO</th>
                 <th width="150">DESCRIPCION</th>
                <th width="50">OPCION</th>
            </tr>';
$prov1 = new Ausencia() or die(mysql_error());
                        $rows4=$prov1->getcondiario();
                        foreach ($rows4 as $row4){
                            echo "<tr>";
                            echo "<td>".$row4->nombre."</td>";
                            echo "<td>".$row4->fechainicio."</td>";
                            echo "<td>".$row4->fechafin."</td>";
                            echo "<td>".$row4->motivo."</td>";
                            echo "<td>".$row4->fechaor."</td>";
                            echo "<td>".$row4->descripcion."</td>";
                            echo '<td><a href="editarausencia.php?id='.$row4->idau.';" class="glyphicon glyphicon-edit"></a> <a href="eliminarausencia.php?id='.$row4->idau.';" class="glyphicon glyphicon-remove-circle"></a></td>';
                            echo "</tr>";
    }
    
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
            
        
    $ag1 = new Ausencia($_POST['nombre'],$_POST['fechaini'],$_POST['fechafin'],$_POST['tipo'],$_POST['message'],$hoy,NULL)or die(mysql_error());
    $res = $ag1->add() or die(mysql_error());
        if($res){
            
           
            $ag2 = new lectorAvisador($_POST['nombre'],FALSE);
            $sa = $ag2->detivate();
             echo "<script>alert('Guardado con Exito')</script>";
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