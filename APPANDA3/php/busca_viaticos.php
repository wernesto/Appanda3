<?php
include 'CLASS/conexion.class.php';
include 'CLASS/asigrutas.class.php';
$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA



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
$prov = new Asigruta($dato) or die(mysql_error());
                        $rows=$prov->getdiario4();
                        if($rows){
                        foreach ($rows as $row){
                            echo "<tr>";
                            echo "<td>".$row->ar_codigolec."</td>";
                            echo "<td>".$row->nombre."</td>";
                             echo "<td>".$row->apellido."</td>";
                            echo "<td>".$row->ar_grupo."</td>";
                            echo "<td>".$row->g_id_agencia."</td>";
                            echo "<td>".$row->id_sector."</td>";
                            echo "<td>".$row->n_ruta."</td>";
                            echo "<td>".$row->fecha_asig."</td>";
                            echo "</tr>";
    }
    }else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';

?>
