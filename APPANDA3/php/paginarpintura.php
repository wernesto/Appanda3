<?php
include('conexion.php');
	$paginaActual = $_POST['partida'];

    $nroProductos = mysql_num_rows(mysql_query("SELECT * from asignacion, ruta,  grupo, lectoravisador, sector WHERE  ar_codigolec=codiglector and ar_grupo=id_grupo  and ar_id_sector=id and ar_nruta=Rid and id_sector!=301 order by fecha_asig desc"));
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

  	$registro = mysql_query("SELECT * from   lectorAvisador,grupo, ruta_pintada, ruta, sector where id_grupo=Pin_id_grupo and codiglector=rp_cod_lector and  id=rp_id_sector and Rid=rp_id_ruta  ORDER BY RPfecha_origen desc");


  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
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
				
	while($registro2 = mysql_fetch_array($registro)){
    

		$tabla = $tabla.'<tr>
              
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
        

    $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
?>