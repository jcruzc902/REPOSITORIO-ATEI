<?php
#combobox anidado segun la actividad principal seleccionada que haga un listado de subactividad
include('../../config.php');

$nombre_actividad= $_POST['nombre_actividad'];

$sql_subactividad = "SELECT 
subactividad.id_subactividad as id_subactividad, 
subactividad.nombre_subactividad as nombre_subactividad, 
subactividad.id_actividad_principal as id_actividad_principal,
actividad_principal.nombre_actividad as nombre_actividad 
FROM tb_subactividad as subactividad 
INNER JOIN tb_actividad_principal as actividad_principal ON actividad_principal.id_actividad_principal=subactividad.id_actividad_principal 
where subactividad.visible!=1 and actividad_principal.nombre_actividad='".$nombre_actividad."' ORDER BY subactividad.nombre_subactividad ASC";
$query_subactividad = $pdo->prepare($sql_subactividad);
$query_subactividad->execute();
$subactividad_datos = $query_subactividad->fetchAll(PDO::FETCH_ASSOC);


    $html = "<option value=''>SELECCIONAR</option>";

foreach($subactividad_datos as $subactividad_dato){

    $html .= "<option value='".$subactividad_dato["nombre_subactividad"]."'>".$subactividad_dato["nombre_subactividad"]."</option>";
}

echo $html;