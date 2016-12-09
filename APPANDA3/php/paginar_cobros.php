<?php
include('conexion.php');
include 'CLASS/conexion.class.php';
	$paginaActual = $_POST['partida'];

    $nroProductos = mysql_num_rows(mysql_query("SELECT * from cobroespecial,lectorAvisador where codiglector=codigo_lec order by fecha_asig desc"));
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

  	$registro = mysql_query("SELECT * from cobroespecial,lectorAvisador where codiglector=codigo_lec order by fecha_asig desc LIMIT $limit, $nroLotes");


  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			           
           <tr>
               <th width="70">CODIGO</th>
                <th width="200">NOMBRE</th>
                <th width="200">APELLIDO</th>
                <th width="150">REFERENCIA</th>
                <th width="150">OBSERVACION</th>
                <th width="150">FECHA</th>
                <th width="50">OPCION</th>
            </tr>';
				
	while($registro2 = mysql_fetch_array($registro)){
    

		$tabla = $tabla.'<tr>
              
            <td>'.$registro2['codiglector'].'</td>
              <td>'.$registro2['nombre'].'</td>
              <td>'.$registro2['apellido'].'</td>
              <td>'.$registro2['n_cuenta_c'].'</td>
              <td>'.$registro2['c_descripcion'].'</td>                     
              <td>'.fechaNormal($registro2['fecha_asig']).'</td>
              <td><a href="editarcobrosespeciales.php?id='.$registro2['cobrID'].';" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$registro2['cobrID'].');" class="glyphicon glyphicon-remove-circle"></a></td>
              </tr>';   
  
	}
        

    $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
?>