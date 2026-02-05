<?php
#combobox anidado segun la resolucion seleccionado que haga un listado del nombre de archivo
include('../../config.php');

$nombre_dependencia= $_POST['nombre_dependencia'];

$sql_dependencias_tyt = "SELECT nombre_dependencias_tyt, 
codigo_facultad FROM tb_dependencias_tyt 
WHERE nombre_dependencias_tyt='".$nombre_dependencia."' ORDER BY nombre_dependencias_tyt ASC ";
$query_dependencia_tyt = $pdo->prepare($sql_dependencias_tyt);
$query_dependencia_tyt->execute();
$dependencia_tyt_datos = $query_dependencia_tyt->fetchAll(PDO::FETCH_ASSOC);


    #$html = "<option value=''>SELECCIONAR</option>";

foreach($dependencia_tyt_datos as $dependencia_tyt_dato){

    $html .= "<option value='".$dependencia_tyt_dato["codigo_facultad"]."'>".$dependencia_tyt_dato["codigo_facultad"]."</option>";
    #$html .= "<input class='form-control' value='".$dependencia_tyt_dato["codigo_facultad"]."'>";

}

echo $html;