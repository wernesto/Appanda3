<?php
include ('conexion.php');
include 'CLASS/conexion.class.php';
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

//COMPROBAMOS QUE LAS FECHAS EXISTAN
if(isset($desde)==false){
	$desde = $hasta;
}

if(isset($hasta)==false){
	$hasta = $desde;
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysql_query("SELECT * from grupo, inspecciones, sector,ruta, lectorAvisador where id_grupo=in_grupo and id=in_sector and Rid=in_ruta and codiglector=in_codigo_lector and  in_fechaOrigen BETWEEN '$desde' AND '$hasta' ORDER BY in_fechaOrigen desc");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

 echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="300">Nombre</th>
                <th width="200">GRUPO</th>
                <th width="150">SECTOR</th>
                <th width="150">RUTA</th>
                <th width="150">SECUENCIA</th>
                <th width="150">LECTURA LEC.</th>
                <th width="150">LECTURA INSP.</th>
                <th width="150">OBSERVACION</th>
                <th width="150">DESCRIPCION</th>
                <th width="150">FECHA</th>
                <th width="50">OPCION</th>
            </tr>';
$prov1 = new Inspecciones() or die(mysql_error());
                        $rows4=$prov1->getcondiario();
                        foreach ($rows4 as $row4){
                            echo "<tr>";
                            echo "<td>".$row4->nombre."</td>";
                            echo "<td>".$row4->in_grupo."</td>";
                            echo "<td>".$row4->id_sector."</td>";
                            echo "<td>".$row4->n_ruta."</td>";
                            echo "<td>".$row4->in_secuencia."</td>";
                            echo "<td>".$row4->leclector."</td>";
                            echo "<td>".$row4->lecinspector."</td>";
                            echo "<td>".$row4->obsev."</td>";
                            echo "<td>".$row4->in_descripcion."</td>";
                            echo "<td>".$row4->in_fechaOrigen."</td>";

                            echo '<td><a href="editarinspecciones.php?id='.$row4->idINSP.';" class="glyphicon glyphicon-edit"></a> <a href="eliminarinspecciones.php?id='.$row4->idINSP.';" class="glyphicon glyphicon-remove-circle"></a></td>';
                            echo "</tr>";
    }
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>