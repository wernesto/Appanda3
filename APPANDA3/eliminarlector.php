<!doctype html>
<html>
    <head>
        <title>Eliminar</title>
       
    </head>
    <body>
        <header>
        <meta http-equiv="refresh" content="1; url=http://localhost:8080/APPANDA3/Nuevo_Lect.php" />
            
        </header>
        <section> 
        
<?php
include 'CLASS/lector.class.php';
include 'CLASS/conexion.class.php';
$id=$_GET['id'];
//echo $id;
if($id){
   if($id){
                $con = new lectorAvisador($id) or die(mysql_error());
                
                        $res = $con->delete() or die(mysql_error());
                
            if($res){
               // echo "Registros Eliminados: ".mysql_affected_rows()."<br/>";
               // echo "<a href='vista previa_002.php'>Regresar</a>";
                echo "<script>alert('Registro Eliminado')</script>";
              
               // setTimeout("location.href='http://localhost/APPANDA/vista%20previa_027.php'",5000);
               

        }
        else{echo "<script>alert('Error! al Eliminar')</script>";}
    }
}
                   
             
?>
        </section>
    </body>
</html>