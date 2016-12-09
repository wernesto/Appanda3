<?php
include('conexion.php');
include 'CLASS/conexion.class.php';
	$paginaActual = $_POST['partida'];

    $nroProductos = mysql_num_rows(mysql_query("SELECT * from grupo, inspecciones, sector,ruta, lectorAvisador where id_grupo=in_grupo and id=in_sector and Rid=in_ruta and codiglector=in_codigo_lector order by in_fechaOrigen desc"));
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

  	$registro = mysql_query("SELECT * from grupo, inspecciones, sector,ruta, lectorAvisador where id_grupo=in_grupo and id=in_sector and Rid=in_ruta and codiglector=in_codigo_lector order by in_fechaOrigen desc LIMIT $limit, $nroLotes");


  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
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
				
	while($registro2 = mysql_fetch_array($registro)){
    

		$tabla = $tabla.'<tr>
              $item = $item+1;
              <td>'.$registro2['$item'].'</td>
            <td>'.$registro2['codiglector'].'</td>
              <td>'.$registro2['nombre'].'</td>
              <td>'.$registro2['in_grupo'].'</td>
              <td>'.$registro2['id_sector'].'</td>
              <td>'.$registro2['n_ruta'].'</td>
              <td>'.$registro2['in_secuencia'].'</td>
              <td>'.$registro2['leclector'].'</td>
              <td>'.$registro2['lecinspector'].'</td>
              <td>'.$registro2['obsev'].'</td>
              <td>'.$registro2['in_descripcion'].'</td>
              <td>'.fechaNormal($registro2['in_fechaOrigen']).'</td>
              <td><a href="editarinspecciones.php?id='.$registro2['idINSP'].';" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$registro2['idINSP'].');" class="glyphicon glyphicon-remove-circle"></a></td>
              </tr>';   
	}
        

    $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
?>