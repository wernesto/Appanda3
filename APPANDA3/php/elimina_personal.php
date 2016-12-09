<?php
include('conexion.php');
include 'CLASS/conexion.class.php';
include 'CLASS/lector.class.php';

$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysql_query("DELETE FROM lectoravisador WHERE codiglector = '$id'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS



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
                <th width="100">OPCION</th>
            </tr>';
$prov = new lectorAvisador() or die(mysql_error());
                        $rows=$prov->getcondiario();
                        if($rows){
                        foreach ($rows as $row){
                            echo "<tr>";
                           
                            echo "<td>".$row->nombre."</td>";
                            echo "<td>".$row->apellido."</td>";
                            echo "<td>".$row->codiglector."</td>";
                            echo "<td>".$row->sexo."</td>";
                            echo "<td>".$row->telefono."</td>";
                            echo "<td>".$row->dui."</td>";
                            echo "<td>".$row->nit."</td>";
                            echo "<td>".$row->afp."</td>";
                            echo "<td>".$row->Afecha."</td>";
                            echo "<td>".$row->tipo."</td>";
                            echo "<td>".$row->lec_descripcion."</td>";
                            echo '<td><a href="editarNuevo_Lect.php?id='.$row->codiglector.';" class="glyphicon glyphicon-edit"></a> <a href="eliminarlector.php?id='.$row->codiglector.';" class="glyphicon glyphicon-remove"></a><a href=".php?id='.$row->codiglector.';" class="glyphicon glyphicon-off"></a><a href=".php?id='.$row->codiglector.';" class="glyphicon glyphicon-ok"></a></td>';
                            echo "</tr>";
    
    }
    }else{
    echo '<tr>
                <td colspan="6">No se encontraron resultados</td>
            </tr>';
}
echo '</table>';

?>