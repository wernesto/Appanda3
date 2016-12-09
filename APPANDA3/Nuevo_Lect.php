
<!DOCTYPE html>
<?php
include 'CLASS/conexion.class.php';
include 'CLASS/lector.class.php'
?>
<html>
<head>
    <meta charset="utf-8">
    <title>NUEVO LEC</title>
    <link rel="stylesheet" media="screen" href="css/style.css" >
    <link href="js/estilo.css" rel="stylesheet">
    <script src="JQUERY/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="JQUERY/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">   
    <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet"> 
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        jQuery(function($){
            // Definimos las mascaras para cada input
            $("#e1").mask("999/99/99");
            $("#e2").mask("9999-9999");
            $("#e3").mask("99999999-9");
            $("#e4").mask("9999-999999-999-9");
            $("#e5").mask("9999");
            $("#co").mask("?");
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
	<form class="contact_form" action=""  data-toggle="validator" method="post" name="contact_form" >
	
		<ul>
    <li>
         <h2>NUEVO LECTOR</h2>
         <span class="required_notification">* Informacion de Lector</span>
    </li>
    <li>
        <label for="name">Nombre:</label>
        <input required  type="text" name="nombre" placeholder="Juan Antonio"/>
    
    <label   id="apel" for="apellido">Apellido:</label>
    <input type="text" name="apellido" required placeholder="Perez Juarez"/>
    
	</li>
	

<li>
    <label for="codigo">Codigo Lec:</label>
    <input required  type="text" id="e5" name="codigo" placeholder="1234" />
    

    <label for="sexo">Sexo:</label>
    <select required type="text" name="sexo" />
    <option> Masculino</option>
    <option> Femenino</option>
    </select>
</li>
<li>
    <label for="telefono">Telefono:</label>
    <input required  type="text" id="e2" name="telefono" placeholder="7000-1111" />
    

    <label for="dui">DUI:</label>
    <input required type="text" id="e3" name="dui" placeholder="01234567-8"/>
    
</li>
<li>
    <label for="nit">NIT:</label>
    <input required type="text" id="e4" name="nit" placeholder="9999-999999-999-9" />
    

    <label for="afp">AFP:</label>
    <input  required  type="number" name="afp"/>
    
</li>
<li>
    <label for="fecha">Fecha de Nacimiento:</label>
    <input type="date"  name="fecha"required  />
    

    <label for="tipo">TIPO:</label>
    <select type="text" name="tipo"required />
     <option> Lector</option>
    <option> Avisador</option>
    <option> Inspector</option>
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
                <th width="200">APELLIDO</th>
                <th width="150">CODIGO LECTOR</th>
                <th width="150">SEXO</th>
                <th width="150">TELEFONO</th>
                <th width="150">DUI</th>
                <th width="300">NIT</th>
                <th width="150">AFP</th>
                <th width="150">FECHA DE NAC.</th>
                <th width="150">CARGO</th>
                <th width="150">OBSERVACION</th>
                <th width="50">OPCION</th>
            </tr>';
$prov = new lectorAvisador() or die(mysql_error());
                        $rows=$prov->getcondiario();
                        foreach ($rows as $row){
                            echo "<tr>";
                            echo "<td>".$row->nombre."</td>";
                            echo "<td>".$row->apellido."</td>";
                            echo "<td>".$row->codiglector."</td>";
                            echo "<td>".$row->sexo."</td>";
                            echo "<td>".$row->telefono."</td>";
                            echo "<td>".$row->dui."</td>";
                            echo "<td>".$row->nit."</td>";
                            echo "<td>".$row->afp."</td>";
                            echo "<td>".$row->Afecha."</td>";
                            echo "<td>".$row->tipo."</td>";
                            echo "<td>".$row->lec_descripcion."</td>";
                            echo '<td><a href="editarNuevo_Lect.php?id='.$row->codiglector.';" class="glyphicon glyphicon-edit"></a> <a href="eliminarlector.php?id='.$row->codiglector.';" class="glyphicon glyphicon-remove-circle"></a></td>';
                            echo "</tr>";
    }

?>
</div>
<?php
    
    if($_POST){
        try {
            $hoy = date("Y-m-d");
        
    $sec = new lectorAvisador($_POST['nombre'],$_POST['apellido'],$_POST['codigo'],$_POST['sexo'],$_POST['telefono'],$_POST['dui'],$_POST['nit'],$_POST['afp'],$_POST['message'],$hoy,$_POST['fecha'],$_POST['tipo'],1)or die(mysql_error());
    $res = $sec->add() or die(mysql_error());
        if($res){
            echo "<script>alert('Guardado con Exito')</script>";
             echo"<script>
                 
                setTimeout(location.href='http://localhost:8080/APPANDA3/Nuevo_Lect.php',300);
                 
        </script>    ";
        }
        } catch (Exception $e) {
            echo "<script>alert('Error! al Guardar Codigo de lector ya existe o faltan Datos')</script>";
        }   
        
    }
    ?>

</body>
</html>