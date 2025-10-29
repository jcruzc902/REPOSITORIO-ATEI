<?php
#combobox anidado segun la resolucion seleccionado que haga un listado del nombre de archivo
include('../../config.php');

$nombre_resolucion= $_POST['nombre_resolucion'];

$sql_resolucion_rectoral = "SELECT nombre_resolucion_tyt, 
archivo FROM tb_resoluciones_tyt 
WHERE nombre_resolucion_tyt='".$nombre_resolucion."' ORDER BY nombre_resolucion_tyt ASC ";
$query_resolucion_rectoral = $pdo->prepare($sql_resolucion_rectoral);
$query_resolucion_rectoral->execute();
$resolucion_rectoral_datos = $query_resolucion_rectoral->fetchAll(PDO::FETCH_ASSOC);


    #$html = "<option value=''>SELECCIONAR</option>";

foreach($resolucion_rectoral_datos as $resolucion_rectoral_dato){

    $html .= "<option value='".$resolucion_rectoral_dato["archivo"]."'>".$resolucion_rectoral_dato["archivo"]."</option>";
}

echo $html;