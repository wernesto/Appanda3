<?php
include('conexion.php');
	$paginaActual = $_POST['partida'];

    $nroProductos = mysql_num_rows(mysql_query("SELECT * from  lectoravisador "));
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

  	$registro = mysql_query("SELECT * from  lectoravisador WHERE   fecha_origen LIMIT $limit, $nroLotes");


  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
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
                <th width="100">OPCION</th>
			            </tr>';
				
	while($registro2 = mysql_fetch_array($registro)){
    

		$tabla = $tabla.'<tr>
              
             
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
              <td><a href="editarNuevo_Lect.php?id='.$registro2['codiglector'].';" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$registro2['codiglector'].');" class="glyphicon glyphicon-remove"></a></td>
              </tr>';   

	}
        

    $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
?>