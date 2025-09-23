<?php
#combobox anidado segun el cargo seleccionado que haga un listado de actividad principal
include('../../config.php');

$resolucion= $_POST['resolucion'];

$sql_resoluciones_egresos = "SELECT * FROM tb_resoluciones_egresos where visible!=1 and resolucion='".$resolucion."'";
$query_resoluciones_egresos = $pdo->prepare($sql_resoluciones_egresos);
$query_resoluciones_egresos->execute();
$resoluciones_egresos_datos = $query_resoluciones_egresos->fetchAll(PDO::FETCH_ASSOC);


    #$html = "<option value=''>SELECCIONAR</option>";
    

foreach($resoluciones_egresos_datos as $resoluciones_egresos_dato){
    $theDate = new DateTime($resoluciones_egresos_dato["fecha"]);
    $resoluciones_egresos_dato["fecha"] = $theDate->format('d/m/Y');

    $html .= "<option value='".$resoluciones_egresos_dato["fecha"]."'>".$resoluciones_egresos_dato["fecha"]."</option>";
}

echo $html;