<?php

$sql_tipo_cargo = "SELECT * FROM tb_cargo where visible!=1 ORDER BY nombre_cargo ASC";
$query_tipo_cargo = $pdo->prepare($sql_tipo_cargo);
$query_tipo_cargo->execute();
$tipo_cargo_datos = $query_tipo_cargo->fetchAll(PDO::FETCH_ASSOC);