<?php
include('conexion.php');
include 'CLASS/cobroespeciales.class.php';
include 'CLASS/conexion.class.php';
include 'CLASS/asigrutas.class.php';

$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysql_query("DELETE FROM asignacion WHERE cobrID. = '$id'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS



//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

 echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="70">CODIGO</th>
                <th width="200">NOMBRE</th>
                <th width="200">APELLIDO</th>
                <th width="150">REFERENCIA</th>
                <th width="150">FECHA</th>
                <th width="150">OBSERVACION</th>
                <th width="50">OPCION</th>
            </tr>';
$prov1 = new  Cobro() or die(mysql_error());
                        $rows4=$prov1->getbuscardiario2();
                        if($rows4){
                        foreach ($rows4 as $row4){
                            echo "<tr>";
                            echo "<td>".$row4->codiglector."</td>";
                            echo "<td>".$row4->nombre."</td>";
                            echo "<td>".$row4->apellido."</td>";
                            echo "<td>".$row4->n_cuenta_c."</td>"; 
                            echo "<td>".$row4->fecha_asig."</td>";                         
                            echo "<td>".$row4->c_descripcion."</td>";
                            echo '<td><a href="editarcobrosespeciales.php?id='.$row4->cobrID.';" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$row4->cobrID.');" class="glyphicon glyphicon-remove-circle"></a></td>';
                            echo "</tr>";
    }
    }else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>