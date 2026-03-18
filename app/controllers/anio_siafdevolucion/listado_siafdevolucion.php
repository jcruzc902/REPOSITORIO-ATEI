<?php

$sql_aniosiafdevolucion = "SELECT * FROM tb_anio_siafdevolucion WHERE id_anio_siafdevolucion!=1 ";
$query_aniosiafdevolucion = $pdo->prepare($sql_aniosiafdevolucion);
$query_aniosiafdevolucion->execute();
$aniosiafdevolucion_datos = $query_aniosiafdevolucion->fetchAll(PDO::FETCH_ASSOC);