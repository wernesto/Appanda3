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

$registro = mysql_query("SELECT * from   lectorAvisador,grupo, ruta_pintada, ruta, sector where id_grupo=Pin_id_grupo and codiglector=rp_cod_lector and  id=rp_id_sector and Rid=rp_id_ruta and   RPfecha_origen BETWEEN '$desde' AND '$hasta'   ORDER BY RPfecha_origen desc ");

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
if(mysql_num_rows($registro)>0){
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
							<td>'.$registro2['codiglector'].'</td>
							<td>'.$registro2['nombre'].'</td>
							<td>'.$registro2['apellido'].'</td>
							<td>'.$registro2['id_grupo'].'</td>
							<td>'.$registro2['id_sector'].'</td>
							<td>'.$registro2['n_ruta'].'</td>
             				<td>'.$registro2['descripcionpin'].'</td>
             				<td>'.fechaNormal($registro2['RPfecha_origen']).'</td>
						 	<td><a href="editarpinturaderuta.php?id='.$registro2['pintu'].';" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$registro2['pintu'].');" class="glyphicon glyphicon-remove-circle"></a></td>
						  </tr>';			

	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>