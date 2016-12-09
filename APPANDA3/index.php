
<?php

require ("funciones.php");

seguridadIndex();

$error = 0;
$registrar=0;

if(isset($_POST['registrar']))
{    
    $registrar = 1;
    $error = registrarUsuario(limpiar($_POST['Name']), $_POST['pass']);
   
}
else if(isset($_POST['login']))
{
    $recordarme=0;
    if(isset($_POST['recordarme']))$recordarme=1;
    $error = login(limpiar($_POST['Name']), $_POST['pass'],$recordarme);
    if($error>0)
    {
        header("Location: index.php");
        exit();
    }
    
}
?>


<!DOCTYPE html>
<?php
include 'CLASS/conexion.class.php';
include 'CLASS/lector.class.php'
?>
<html>


<head>
    <meta charset="utf-8">
    <title>LOGIN:</title>
    <link rel="stylesheet" media="screen" href="css/style.css" >
    <link href="js/estilo.css" rel="stylesheet">
    <script src="JQUERY/jquery-1.9.1.js" type="text/javascript"></script>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">   
    <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet"> 
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <style type="text/css">
        footer{
            text-align: center;
            color: #ffffff;
            background-color: #6666FF}
        strong{
            text-align: center;
            color:#ffffff;
               background-color: #000000 }
    </style> 
</head>

<body>

<div align="center">
	<img src="imagen/logo.jpg" />
</div>
<div id="menus" class"menus">

</div>
<div id="box1" class="box">
	<form class="contact_form" action=""  data-toggle="validator" method="post" name="login" >
	
	<ul>
    <center>
    <li>
         <h2>INICIO DE SESION</h2>
         <span class="required_notification">* Ingrese su Login.</span>
    </li>
    <li>
        <label for="name">Nombre:</label>
        <input  type="text" name="Name" autofocus/>
    </li>
    <li>
    <label   id="apel" for="apellido">Contraseña</label>
    <input type="password" name="pass" />
    
	</li>
    <li>
    <button class="submit" type="submit" name="login">VALIDAR</button>
    <button class="submit1" type="reset" >LIMPIAR</button> 
    
    </li>
	</center>


</ul>
<ul><li>
    <center>
        <label>Recordar: </label><input type="checkbox" id="recordarme" name="recordarme" />
    </center>
</li></ul>
<ul>
    <li>
        <?php
            switch ($error) {
                case -1://login
                    echo '<br/><strong>Usuario o Password incorrecta</strong>';
                    break;
                case -2://registro
                    echo '<br/><strong>Error al registrarse. Usuario ya existente.</strong>';
                    break;
                case -3://registro
                    echo '<br/><strong>El usuario y la contraseña deben tener como mínimo 4 carácteres.</strong>';
                    break;
                default:
                    if($registrar) echo '<br/><strong>Se ha registrado correctamente.</strong>';
                    break;
            }
            ?>

    </li>
</ul>
<br>
<br>
</form>
</div>
<footer>Derechos Reservados por el Autor @Wernesto66</footer>
</body>
</html>