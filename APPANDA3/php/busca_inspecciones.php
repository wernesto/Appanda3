<?php
include 'CLASS/conexion.class.php';
include 'CLASS/grupo.class.php';
include 'CLASS/lector.class.php';
include 'CLASS/sector.class.php';
include 'CLASS/ruta.class.php';
include 'CLASS/inspecciones.class.php';
include('conexion.php');
$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA



//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

 
     echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="150">CODIGO</th>
                <th width="300">NOMBRE</th>
                <th width="90">GRUPO</th>
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
                        $rows4=$prov1->getcondiario2();
                          if ($rows4) {   
                        foreach ($rows4 as $row4){
                            echo "<tr>";
                            echo "<td>".$row4->codiglector."</td>";
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
