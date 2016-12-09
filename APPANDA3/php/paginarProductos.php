<?php
include('conexion.php');
	$paginaActual = $_POST['partida'];

    $nroProductos = mysql_num_rows(mysql_query("SELECT * from asignacion, ruta,  grupo, lectoravisador, sector WHERE  ar_codigolec=codiglector and ar_grupo=id_grupo  and ar_id_sector=id and ar_nruta=Rid order by fecha_asig desc"));
    $nroLotes = 10;
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '';
    $tabla = '';

    if($paginaActual > 1){
        $lista = $lista.'<li><a href="javascript:pagination('.($paginaActual-1).');">Anterior</a></li>';
    }
    for($i=1; $i<=$nroPaginas; $i++){
        if($i == $paginaActual){
            $lista = $lista.'<li class="active"><a href="javascript:pagination('.$i.');">'.$i.'</a></li>';
        }else{
            $lista = $lista.'<li><a href="javascript:pagination('.$i.');">'.$i.'</a></li>';
        }
    }
    if($paginaActual < $nroPaginas){
        $lista = $lista.'<li><a href="javascript:pagination('.($paginaActual+1).');">Siguiente</a></li>';
    }
  
  	if($paginaActual <= 1){
  		$limit = 0;
  	}else{
  		$limit = $nroLotes*($paginaActual-1);
  	}

  	$registro = mysql_query("SELECT * from asignacion, ruta,  grupo, lectoravisador, sector WHERE ar_codigolec=codiglector and ar_grupo=id_grupo  and ar_id_sector=id and ar_nruta=Rid order by fecha_asig desc LIMIT $limit, $nroLotes");


  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			            <tr>
                      
                      <th width="50">Codigo</th>
			                <th width="300">Nombre</th>
                       <th width="300">Apellido</th>
			                <th width="75">Grupo</th>
			                <th width="75">Agencia</th>
			                <th width="75">Sector</th>
			                <th width="75">Ruta</th>
                      <th width="100">Herramienta</th>
                      <th width="350">Observacion</th>
                      <th width="100">Fecha</th>
			                <th width="50">Opciones</th>
			            </tr>';
				
	while($registro2 = mysql_fetch_array($registro)){
    

		$tabla = $tabla.'<tr>
              
              <td>'.$registro2['codiglector'].'</td>
							<td>'.$registro2['nombre'].'</td>
              <td>'.$registro2['apellido'].'</td>
							<td>'.$registro2['ar_grupo'].'</td>
							<td>'.$registro2['g_id_agencia'].'</td>
							<td>'.$registro2['id_sector'].'</td>
              <td>'.$registro2['n_ruta'].'</td>
              <td>'.$registro2['herramienta'].'</td>
              <td>'.$registro2['ar_observacionasig'].'</td>
							<td>'.fechaNormal($registro2['fecha_asig']).'</td>
							<td><a href="editarasignacion.php?id='.$registro2['asigID'].';" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$registro2['asigID'].');" class="glyphicon glyphicon-remove-circle"></a></td>
						  </tr>';		
	}
        

    $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
?>