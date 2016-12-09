<?php
require ("funciones.php");
seguridad();
?>
<!DOCTYPE html>
<?php
include 'CLASS/conexion.class.php';
include 'CLASS/agencia.class.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Creaar Agencia</title>
    <link rel="stylesheet" media="screen" href="css/stylerutas.css" >
    <script src="JQUERY/jquery-1.11.1.min.js" type='text/javascript' ></script>
    <script type='text/javascript' src='JQUERY/menu_jquery.js'></script>
    <script src="js/jquery.js"></script>
    <script src="js/myjava.js"></script>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">   
    <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet"> 
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="JQUERY/jquery.maskedinput.min.js" type="text/javascript"></script>
     <script type="text/javascript">
        jQuery(function($){
            // Definimos las mascaras para cada input
            $("#e18").mask("99");
            $("#e17").mask("99");
           
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
                $con = new Agencia($_GET['id']) or die(mysql_error());
                
                        $res = $con->getcondiario() or die(mysql_error());
                        foreach ($res as $row3){
                        
                            ?>
	<form class="contact_form" action=""  method="post" name="contact_form">
	
		<ul>
    <li>
         <h2>Editar Crear Agencia</h2>
         <span class="required_notification">*Editar Creacion de Agencias</span>
    </li>
    <li>
        <label for="name">Lugar:</label>
        <select type="text" name="lugar" required />
            <option><?=$row3->n_de_agencia?></option>
            <option>Oriente</option>
            
        </select>
    
    <label for="grupo">N° de Agencia</label>
    <input id="e18" value="<?=$row3->id_agencia?>" type="text" name="agencia"  required />
    
</li>



<li>
    <button class="submit" type="submit">GUARDAR</button>
    <button class="submit1" type="reset" >LIMPIAR</button> 
    
</li>
</ul>
</form>
<?php
                        }
                        
                 
                endif;
           
            ?>
</div>

</div>

<?php
   
    if($_POST){
    
    $hoy = date("Y-m-d"); 
    
             $con= new Agencia($_POST['agencia'],$_POST['lugar'],$hoy) or die(mysql_error());
                        $res = $con->update() or die(mysql_error());
                         

   
                        }
                        
             
    
    ?>
</body>

</html>