<?php
#combobox anidado segun el cargo seleccionado que haga un listado de actividad principal
include('../../config.php');

$nombre_cargo= $_POST['nombre_cargo'];

$sql_actividad_principal = "SELECT 
actividad_principal.id_actividad_principal as id_actividad_principal, 
actividad_principal.nombre_actividad as nombre_actividad, 
actividad_principal.id_cargo as id_cargo,
cargo.nombre_cargo as nombre_cargo 
FROM tb_actividad_principal as actividad_principal 
INNER JOIN tb_cargo as cargo ON cargo.id_cargo=actividad_principal.id_cargo 
where actividad_principal.visible!=1 and cargo.nombre_cargo='".$nombre_cargo."' ORDER BY actividad_principal.nombre_actividad ASC ";
$query_actividad_principal = $pdo->prepare($sql_actividad_principal);
$query_actividad_principal->execute();
$actividad_principal_datos = $query_actividad_principal->fetchAll(PDO::FETCH_ASSOC);


    $html = "<option value=''>SELECCIONAR</option>";

foreach($actividad_principal_datos as $actividad_principal_dato){

    $html .= "<option value='".$actividad_principal_dato["nombre_actividad"]."'>".$actividad_principal_dato["nombre_actividad"]."</option>";
}

echo $html;