<!doctype html>
<html>
    <head>
        <title>Eliminar</title>
       
    </head>
    <body>
        <header>
           
            <meta http-equiv="refresh" content="1; url=http://localhost:8080/APPANDA3/crearsector.php" />
        </header>
        <section>
<?php
include 'CLASS/sector.class.php';
include 'CLASS/conexion.class.php';
$id=$_GET['id'];

if($id):
   if($id):
                $con = new Sector($id) or die(mysql_error());
                
                        $res = $con->delete() or die(mysql_error());
                
            if($res):
            echo "<script>alert('Registro Eliminado')</script>";
            endif;
        
    endif;
endif;

?>
        </section>
    </body>
</html>