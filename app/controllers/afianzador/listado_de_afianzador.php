<?php

$sql_afianzador = "SELECT * FROM tb_afianzador_cf where id_afianzador_cf!=1 and visible!=1 ORDER BY nombre_afianzador ASC";
$query_afianzador = $pdo->prepare($sql_afianzador);
$query_afianzador->execute();
$afianzador_datos = $query_afianzador->fetchAll(PDO::FETCH_ASSOC);