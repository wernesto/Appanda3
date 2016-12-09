<?php
require ("funciones.php");
include('php/conexion.php');
$error = 0;

 seguridad(); //comprobamos que se esté logueado

if(isset($_POST['salir']))
{    
    
    destruirCookie($_COOKIE['identificado']);
    
    $_SESSION = array();
 
    //guardar el nombre de la sessión para luego borrar las cookies
    $session_name = session_name();
 
    //Para destruir una variable en específico
    unset($_SESSION['usuario']);
 
    // Finalmente, destruye la sesión
    session_destroy();
 
    // Para borrar las cookies asociadas a la sesión
    // Es necesario hacer una petición http para que el navegador las elimine
    if ( isset( $_COOKIE[ $session_name ] ) ) {
        setcookie($session_name, '', time()-3600, '/');   
    }
    if(isset($_COOKIE['identificado'])){
        setcookie('identificado', '', time()-3600, '/'); 
    }
    header("Location: index.php");
    exit();
   
}
$nam=$_SESSION['usuario'];
$row=mysql_query("SELECT login from usuario where idUsuario='$nam'");
$res=mysql_fetch_array($row);
?>
<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/stylesmenu.css">
   <script type='text/javascript' src='JQUERY/menu_jquery.js'></script>

</head>
<body>

<div id='cssmenu'>
    <ul>
   <li class='active'><a href='index.php'><span>Inicio</span></a></li>
   <li class='has-sub'><a href='#'><span>Personal</span></a>
      <ul>
         <li><a href='Nuevo_Lect.php'><span>Nuevo Lector</span></a></li>
         <li><a href='ausencia.php'><span>Ausencia de Personal</span></a></li>
         <li ><a href='buscarpersonal.php'><span>Personal de Lectura</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Asignacion</span></a>
      <ul>
         <li><a href='asignarruta.php'><span>Ruta</span></a></li>
         <li><a href='pinturaderuta.php'><span>Pintura de Rutas</span></a></li>
         <li><a href='asignaciondehandheld.php'><span>HandHeld</span></a></li>
         <li><a href='inspecciones.php'><span>Inspecciones</span></a></li>
         <li><a href='cobrosespeciales.php'><span>Cobro Especial</span></a></li>
         <li><a href='buscagrafiinspecciones.php'><span>Grafica de Inspecciones</span></a></li>
         
      </ul>
   </li>
  <li class='has-sub last'><a href='#'><span>Registros</span></a>
      <ul>
         <li><a href='crearagencia.php'><span>Nueva Agencia</span></a></li>
         <li><a href='creargrupo.php'><span>Nuevo Grupo</span></a></li>
       <li><a href='crearsector.php'><span>Nueva Sector</span></a></li>
         <li><a href='crearruta.php'><span>Nueva Ruta</span></a></li>
         
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Reportes</span></a>
      <ul>
         <li><a href='buscarasigruta.php'><span>Asig. de Rutas</span></a></li>
         <li><a href='buscarrutas.php'><span>Catalogo de Rutas</span></a></li>
         <li><a href='buscarinspeccion.php'><span>Inspecciones.</span></a></li>
         <li><a href='buscarcobros.php'><span>Cobros Esp.</span></a></li>
         <li><a href='buscarbiaticos.php'><span>Biaticos</span></a></li>
         <li><a href='buscarpintura.php'><span>Pintura de Rutas</span></a></li>
          <li><a href='buscargrafica.php'><span>Grafica de Pastel</span></a></li>
          <li><a href='buscarcolumnas.php'><span>Grafica de Columnas</span></a></li>
          <li><a href='buscarasigrutarespaldo.php'><span>Reporte de R.</span></a></li>
          <li><a href='buscarlectormasruta.php'><span>Lector con mas rutas.</span></a></li>
      </ul>
   </li>
  <li class='has-sub'><a href='#'><span>LOGIN:<?php echo $res['0']?></span></a>
        <ul>

       <li><a href=''><span><form method="post" >
   <BUTTON type="submit" class="submit1"  name="salir" id="salir" value="SALIR" />SALIR</BUTTON>
   </form></span></a>
   </li>
      </ul>
   </li>   
</ul>
</div>

</body>
<html>
