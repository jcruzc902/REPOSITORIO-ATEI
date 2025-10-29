<?php

$sql_subactividad = "SELECT subactividad.id_subactividad as id_subactividad,
subactividad.nombre_subactividad as nombre_subactividad,
actividad_principal.id_actividad_principal as id_actividad_principal,
actividad_principal.nombre_actividad as nombre_actividad_principal,
cargo.nombre_cargo as nombre_cargo
FROM tb_subactividad as subactividad 
INNER JOIN tb_actividad_principal as actividad_principal ON actividad_principal.id_actividad_principal = subactividad.id_actividad_principal 
LEFT JOIN tb_cargo as cargo ON cargo.id_cargo= actividad_principal.id_cargo 
WHERE subactividad.visible!=1 ORDER BY subactividad.nombre_subactividad ASC";
$query_subactividad = $pdo->prepare($sql_subactividad);
$query_subactividad->execute();
$subactividad_datos = $query_subactividad->fetchAll(PDO::FETCH_ASSOC);