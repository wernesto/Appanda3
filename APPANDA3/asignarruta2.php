
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
   
        <script type="text/javascript">
        $(document).ready(function() {
         $(".js-example-basic-single").select2();
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
	<div>
		<ul>
    <li>
         <h2>Asignacion de Rutas</h2>
         <span class="required_notification">*Asignacion con Adndalec,HandHeld,Promedio</span>
    </li>
    <table class="table table-condensed">
     
    <tbody>
  <!-- Aplicadas en las filas -->
  <tr class="active"><label>LECTOR:</label></tr>
  <tr class="success" ><label style=" text-align: center;">FECHA:</label></tr>
  <tr class="warning"><label style=" text-align: center;">GRUPO:</label></tr>
  <tr class="active"><label>HERRAMIENTA:</label></tr>
  <tr class="active"><label style=" text-align: center;">SECTOR:</label></tr>
  <tr class="success"><label>RUTA:</label></tr>
  <tr class="warning"><label>DESCRIPCION:</label></tr>
 
 
  <?php
        
            if($_GET):
                $con = new Ruta($_GET['grupo']) or die(mysql_error());
                
                        $res = $con->getrutas2() or die(mysql_error());
                        foreach ($res as $row3){
                           
                        
                            ?>
  <tr>
    <td class="active"><select id="select" name="nombre[]" style="width:150px;" class="js-example-basic-single"  required >
            <option></option>
            <?php
                foreach ($rows as $row){
                    echo "<option value='".$row->codiglector."'>"
                                           .$row->nombre. " ".$row->apellido 

                          ."</option>";
                }
            ?>
            
        </select></td>
    <td class="success"><input type="date" id="fecha" name="fecha[]" required value="<?php echo $hoy?>" /></td>
    <td class="warning"><select id="e18"  name="grupo[]" style="width:100px;" required class="js-example-basic-single">
        <option value="<?=$row3->s_id_grupo?>"><?=$row3->s_id_grupo?></option>
       
            </select>
        </td>
    <td class="danger"><select type="text" style="width:100px;" class="js-example-basic-single" name="tipo[]" required >
         <option>Andalec</option>
         <option>HandHeld</option>
         <option>Promedio</option>
    </select></td>
    <td class="active"><select id="e17" style="width:100px;" type="text" name="sector[]"  required class="js-example-basic-single">
    <option value="<?=$row3->id?>"> <?=$row3->id_sector?>   </option>
    </select></td>
    <td class="success"><select type="text" style="width:100px;" name="ruta[]" id="e15" required class="js-example-basic-single">
    <option value="<?=$row3->Rid?>"><?=$row3->n_ruta?></option>
    </select></td>
    <td class="warnig"><textarea name="message[]" style="width:100px;height: 30px;"/></textarea></td> 
  </tr>
</tbody>
     <?php
                        }
                        
                 
                endif;
           
            ?>

</table>
<li>
    <button class="submit" type="submit">GUARDAR</button>
    <button class="submit1" type="reset" >LIMPIAR</button> 
    
</li>
</ul>
</div>
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
            $fecha=$_POST['fecha'];
            $tipo=$_POST['tipo'];
            $grupo=$_POST['grupo'];
            $sector=$_POST['sector'];
            $nombre=$_POST['nombre'];
            $message=$_POST['message'];
            $rutas=count($_POST['ruta']);
            $ruta=$_POST['ruta'];

            for ($i=0; $i < $rutas ; $i++) { 
               
          
    $ag1 = new Asigruta($fecha[$i],$tipo[$i],$grupo[$i],$sector[$i],$ruta[$i],$nombre[$i],$hoy,$message[$i],null)or die(mysql_error());
    $res = $ag1->add() or die(mysql_error());

      }
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