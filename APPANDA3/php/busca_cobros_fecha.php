<?php
include('conexion.php');

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

$registro = mysql_query("SELECT * from cobroespecial,lectorAvisador where codiglector=codigo_lec  and  fecha_asig BETWEEN '$desde' AND '$hasta' ORDER BY fecha_asig desc");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
            <tr>
            	<th width="70">CODIGO</th>
                <th width="200">NOMBRE</th>
                <th width="200">APELLIDO</th>
                <th width="150">REFERENCIA</th>
                <th width="150">OBSERVACION</th>
                <th width="150">FECHA</th>
                <th width="50">OPCION</th>
            </tr>';
if(mysql_num_rows($registro)>0){
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
						<td>'.$registro2['codiglector'].'</td>
							<td>'.$registro2['nombre'].'</td>
							<td>'.$registro2['apellido'].'</td>
							<td>'.$registro2['n_cuenta_c'].'</td>
							<td>'.$registro2['c_descripcion'].'</td>            				 
							<td>'.fechaNormal($registro2['fecha_asig']).'</td>
							<td><a href="editarcobrosespeciales.php?id='.$registro2['cobrID'].';" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$registro2['cobrID'].');" class="glyphicon glyphicon-remove-circle"></a></td>
						  </tr>';		

	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>