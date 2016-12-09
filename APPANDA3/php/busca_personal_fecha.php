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

$registro = mysql_query("SELECT * from  lectoravisador WHERE  fecha_origen BETWEEN '$desde' AND '$hasta' ORDER BY fecha_origen desc");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="200">NOMBRE</th>
                <th width="200">APELLIDO</th>
                <th width="50">CODIGO</th>
                <th width="150">SEXO</th>
                <th width="150">TELEFONO</th>
                <th width="150">DUI</th>
                <th width="150">NIT</th>
                <th width="150">AFP</th>
                <th width="150">FECHA DE NAC.</th>
                <th width="150">CARGO</th>
                <th width="100">OBSERVACION</th>
                <th width="75">ESTADO</th>
                <th width="100">OPCION</th>
            </tr>';
if(mysql_num_rows($registro)>0){
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
						
							<td>'.$registro2['nombre'].'</td>
							<td>'.$registro2['apellido'].'</td>
							<td>'.$registro2['codiglector'].'</td>
							<td>'.$registro2['sexo'].'</td>
							<td>'.$registro2['telefono'].'</td>
             				 <td>'.$registro2['dui'].'</td>
             				 <td>'.$registro2['nit'].'</td>
             				 <td>'.$registro2['afp'].'</td>
							<td>'.fechaNormal($registro2['Afecha']).'</td>
							 <td>'.$registro2['tipo'].'</td>
							 <td>'.$registro2['lec_descripcion'].'</td>
							 <td><a href="editarNuevoLector.php?id='.$registro2['codiglector'].';" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$registro2['codiglector'].');" class="glyphicon glyphicon-remove"></a></td>
						  </tr>';		

	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>