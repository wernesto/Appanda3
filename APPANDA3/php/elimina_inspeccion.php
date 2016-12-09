<?php
include('conexion.php');
include 'CLASS/conexion.class.php';
include 'CLASS/grupo.class.php';
include 'CLASS/lector.class.php';
include 'CLASS/sector.class.php';
include 'CLASS/ruta.class.php';
include 'CLASS/inspecciones.class.php';
$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysql_query("DELETE FROM inspecciones WHERE idINSP = '$id'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS



//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

  echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="50">CODIGO</th>
                <th width="200">NOMBRE</th>
                <th width="200">APELLIDO</th>
                <th width="200">GRUPO</th>
                <th width="75">SECTOR</th>
                <th width="75">RUTA</th>
                <th width="75">SECUENCIA</th>
                <th width="100">FECHA</th>
                 <th width="150">OBSERVACION</th>
                <th width="50">OPCION</th>
            </tr>';
$prov1 = new Inspecciones() or die(mysql_error());
                        $rows4=$prov1->getcondiario2();
                        if($rows4){
                        foreach ($rows4 as $row4){
                            echo "<tr>";
                            echo "<td>".$row4->codiglector."</td>";
                            echo "<td>".$row4->nombre."</td>";
                            echo "<td>".$row4->apellido."</td>";
                            echo "<td>".$row4->in_grupo."</td>";
                            echo "<td>".$row4->id_sector."</td>";
                            echo "<td>".$row4->n_ruta."</td>";
                            echo "<td>".$row4->in_secuencia."</td>";
                            echo "<td>".$row4->in_fechaOrigen."</td>";
                            echo "<td>".$row4->in_descripcion."</td>";
                            echo '<td><a href="editarinspecciones.php?id='.$row4->idINSP.';" class="glyphicon glyphicon-edit"></a> <a  href="javascript:eliminarProducto('.$row4->idINSP.');" class="glyphicon glyphicon-remove-circle"></a></td>';
                            echo "</tr>";
    }
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>