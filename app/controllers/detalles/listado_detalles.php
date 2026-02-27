<?php

$sql_detalles = "SELECT * FROM tb_detalles ORDER BY nombre_detalles ASC";
$query_detalles = $pdo->prepare($sql_detalles);
$query_detalles->execute();
$detalles_datos = $query_detalles->fetchAll(PDO::FETCH_ASSOC);