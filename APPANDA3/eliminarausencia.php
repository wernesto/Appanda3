<!doctype html>
<html>
    <head>
        <title>Eliminar</title>
       
    </head>
    <body>
        <header>
          <meta http-equiv="refresh" content="1; url=http://localhost:8080/APPANDA3/ausencia.php" />
        </header>
        <section>
<?php
include 'CLASS/ausencia.class.php';
include 'CLASS/conexion.class.php';
$id=$_GET['id'];


   if($id){ 
             $con = new Ausencia($id) or die(mysql_error());
                
                        $res = $con->delete() or die(mysql_error());
                
            if($res){
               echo "<script>alert('Registro Eliminado')</script>";
            }
        
              
        

}

?>
        </section>
    </body>
</html>