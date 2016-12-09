<?php
include 'CLASS/conexion.class.php';
include 'CLASS/grupo.class.php';
include 'CLASS/lector.class.php';
include 'CLASS/sector.class.php';
include 'CLASS/ruta.class.php';
include 'CLASS/cobroespecial.class.php';
include 'CLASS/inspecciones.class.php';
include('conexion.php');
$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA



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
$prov1 = new  Cobro($dato) or die(mysql_error());
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
