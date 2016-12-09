<?php
include 'CLASS/conexion.class.php';
include 'CLASS/grupo.class.php';
include 'CLASS/asigrutas.class.php';
include 'CLASS/lector.class.php';
include 'CLASS/sector.class.php';
include 'CLASS/ruta.class.php';
include 'CLASS/pintura.class.php';
$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA



//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

 
    echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="50">CODIGO</th>
                <th width="300">NOMBRE</th>
                <th width="300">APELLIDO</th>
                <th width="200">GRUPO</th>             
                <th width="150">SECTOR</th>
                <th width="150">RUTA</th>
                <th width="150">OBSERVACION</th>
                <th width="150">FECHA</th>
                <th width="50">OPCION</th>
            </tr>';
$prov1 = new Pintu($dato) or die(mysql_error());
                        $rows4=$prov1->getbuscardia2();
                        if($rows4){
                        foreach ($rows4 as $row4){
                            echo "<tr>";
                             echo "<td>".$row4->codiglector."</td>";
                            echo "<td>".$row4->nombre."</td>";
                            echo "<td>".$row4->apellido."</td>";
                            echo "<td>".$row4->id_grupo."</td>";
                            echo "<td>".$row4->id_sector."</td>";
                            echo "<td>".$row4->n_ruta."</td>";
                            
                            echo "<td>".$row4->descripcionpin."</td>";
                            echo "<td>".$row4->RPfecha_origen."</td>";
                            echo '<td><a href="editarpinturaderuta.php?id='.$row4->pintu.';" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$row4->pintu.');" class="glyphicon glyphicon-remove-circle"></a></td>';
                            echo "</tr>";
    }
    }else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';

?>
