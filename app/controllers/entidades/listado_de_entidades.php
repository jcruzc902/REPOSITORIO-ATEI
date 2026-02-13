<?php

$sql_entidades = "SELECT * FROM tb_entidad_cf where id_entidad_cf!=1 and visible!=1 ORDER BY nombre_entidad ASC";
$query_entidades = $pdo->prepare($sql_entidades);
$query_entidades->execute();
$entidades_datos = $query_entidades->fetchAll(PDO::FETCH_ASSOC);