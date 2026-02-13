<?php

$sql_actividad_principal = "SELECT actividad.id_actividad_principal as id_actividad_principal,
actividad.nombre_actividad as nombre_actividad,
cargo.id_cargo as id_cargo,
cargo.nombre_cargo as nombre_cargo 
FROM tb_actividad_principal as actividad
INNER JOIN tb_cargo as cargo ON cargo.id_cargo = actividad.id_cargo 
WHERE actividad.visible!=1 ORDER BY actividad.nombre_actividad ASC";
$query_actividad_principal = $pdo->prepare($sql_actividad_principal);
$query_actividad_principal->execute();
$actividad_principal_datos = $query_actividad_principal->fetchAll(PDO::FETCH_ASSOC);