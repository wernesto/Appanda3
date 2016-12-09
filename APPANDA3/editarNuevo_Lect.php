
<!DOCTYPE html>
<?php
include 'CLASS/conexion.class.php';
include 'CLASS/lector.class.php'
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar NUEVO LEC</title>
    <link rel="stylesheet" media="screen" href="css/style.css" >
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
 <?php
        
            if($_GET):
                $con = new lectorAvisador($_GET['id']) or die(mysql_error());
                
                        $res = $con->getcondiario2() or die(mysql_error());
                        foreach ($res as $row3){
                        
                            ?>

	<form class="contact_form" action=""  data-toggle="validator" method="post" name="contact_form" >
	
		<ul>
    <li>
         <h2>EDITAR NUEVO LECTOR</h2>
         <span class="required_notification">*Editar Informacion de Lector</span>
    </li>
    <li>
        <label for="name">Nombre:</label>
        <input required  type="text" name="nombre"  value="<?=$row3->nombre?>"  placeholder="Juan Antonio"/>
    
    <label   id="apel" for="apellido">Apellido:</label>
    <input type="text" name="apellido"  value="<?=$row3->apellido?>" required placeholder="Perez Juarez"/>
    
	</li>
	

<li>
    <label for="codigo">Codigo Lec:</label>
    <input required  type="text"  name="codigo" id="e5" disabled="" value="<?=$row3->codiglector?>" placeholder="1234" />
    

    <label for="sexo">Sexo:</label>
    <select required type="text" name="sexo" />
    <option><?=$row3->sexo?></option>
    <option> Masculino</option>
    <option> Femenino</option>
    </select>
</li>
<li>
    <label for="telefono">Telefono:</label>
    <input required  type="text" id="e2" name="telefono" value="<?=$row3->telefono?>" placeholder="7000-1111" />
    

    <label for="dui">DUI:</label>
    <input required type="text" id="e3" name="dui" value="<?=$row3->dui?>" placeholder="01234567-8"/>
    
</li>
<li>
    <label for="nit">NIT:</label>
    <input required type="text" id="e4" name="nit"  value="<?=$row3->nit?>" placeholder="9999-999999-999-9" />
    

    <label for="afp">AFP:</label>
    <input  required  type="number"  value="<?=$row3->afp?>" name="afp"/>
    
</li>
<li>
    <label for="fecha">Fecha de Nacimiento:</label>
    <input type="date"  value="<?=$row3->Afecha?>"  name="fecha"required  />
    

    <label for="tipo">TIPO:</label>
    <select type="text" name="tipo"required />
    <option><?=$row3->tipo?></option>
     <option> Lector</option>
    <option> Avisador</option>
    <option> Inspector</option>
    </select>
</li>
<li>
    <label for="message">Descripcion:</label>
    <textarea name="message" cols="40" rows="6"  required><?=$row3->lec_descripcion?></textarea>
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


        
            $hoy = date("Y-m-d");
        
    $sec = new lectorAvisador($_POST['nombre'],$_POST['apellido'],$_GET['id'],$_POST['sexo'],$_POST['telefono'],$_POST['dui'],$_POST['nit'],$_POST['afp'],$_POST['message'],$hoy,$_POST['fecha'],$_POST['tipo'],1)or die(mysql_error());
    $res = $sec->update() or die(mysql_error());
        if($res){
            echo "<script>alert('Guardado con Exito')</script>";
        }
          
        
    }
    ?>

</body>
</html>