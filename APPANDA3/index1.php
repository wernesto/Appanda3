
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


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Generado por Tecnología Avanquest v:8.0. Para su mayor información, por favor visite: http://www.avanquest.com -->
<!-- saved from url=(0014)about:internet -->
<html lang="es">
<head>
	<title> Inicion de Sesion </title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Style-Type" content="text/css;">
	<link rel="stylesheet" href="vista%20previa_g.css" type="text/css" media="screen,projection,print">	<!--// Document Style //-->
	<link rel="stylesheet" href="vista%20previa_014_p.css" type="text/css" media="screen,projection,print">	<!--// Page Style //-->
	<script src="vista%20previa_g.js" type="text/javascript"></script>
		<!--// Document Script //-->

	

</head>


<body>
<div id="page" class="page">
	<div id="e13" class="page_box"></div>
	<div id="e12" class="footer_box"></div>
	<h6 id="e11" class="footer">
		Compañía
	</h6>
	<h6 id="e10" class="footer">
		APANDA copyright(C) 2014  
	</h6>
	<h4 id="e9" class="page_tag">
		INICIO DE SESION
	</h4>
	<span id="e8"></span>
	<span id="e7"></span>
<form id="f6" action="" name="login" method="post" onsubmit="return weCheckForm(this)">
<fieldset id="e6" class="cc52">
	<label id="e5" class="cc53" for="e4">
		Nombre:
	</label>
	<input id="e4" class="cc54" type="text" name="Name" title="Nombre" size="23"><br>
	<label id="e3" class="cc53" for="e2">
		Password:
	</label>
	<input id="e2" class="cc54" type="password" name="pass" title="pass" size="23"><br>
	<input id="e1" class="cc53" type="submit" name="login" title="Envíar detalles" value="VALIDAR"><br>
	
	<label id="e24" class="cc54" type="text" for="recordarme">Recordarme: </label><br>

	<input type="checkbox" id="recordarme" name="recordarme" />
	<?php
            switch ($error) {
                case -1://login
                    echo '<br/><strong class="cc55" >Usuario o Password incorrecta</strong>';
                    break;
                case -2://registro
                    echo '<br/><strong class="cc55">Error al registrarse. Usuario ya existente.</strong>';
                    break;
                case -3://registro
                    echo '<br/><strong class="cc55">El usuario y la contraseña deben tener como mínimo 4 carácteres.</strong>';
                    break;
                default:
                    if($registrar) echo '<br/><strong class="cc55">Se ha registrado correctamente.</strong>';
                    break;
            }
            ?>
</fieldset>
</form>
</div>
</body>
</html>
