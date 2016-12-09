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

$registro = mysql_query("SELECT * from asignacion, ruta,  grupo, lectoravisador, sector WHERE  ar_codigolec=codiglector and ar_grupo=id_grupo  and ar_id_sector=id and ar_nruta=Rid  and  fecha_asig BETWEEN '$desde' AND '$hasta' and  id_sector!=301 and codiglector!=0000 ORDER BY fecha_asig,ar_grupo,id,Rid desc");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            				<th width="50">Codigo</th>
			                <th width="300">Nombre</th>
			                <th width="300">Apellido</th>
			                <th width="75">Grupo</th>
			                <th width="75">Agencia</th>
			                <th width="75">Sector</th>
			                <th width="75">Ruta</th>
                    	  <th width="100">Fecha</th>
			                
            </tr>';
if(mysql_num_rows($registro)>0){
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['codiglector'].'</td>
							<td>'.$registro2['nombre'].'</td>
							<td>'.$registro2['apellido'].'</td>
							<td>'.$registro2['ar_grupo'].'</td>
							<td>'.$registro2['g_id_agencia'].'</td>
							<td>'.$registro2['id_sector'].'</td>
             				<td>'.$registro2['n_ruta'].'</td>
             				<td>'.fechaNormal($registro2['fecha_asig']).'</td>
						  </tr>';		

	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>