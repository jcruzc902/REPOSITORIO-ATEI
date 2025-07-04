<?php

$sql_anio_periodo = "SELECT * FROM tb_anio_periodo WHERE id_anio_periodo!=1 ";
$query_anio_periodo = $pdo->prepare($sql_anio_periodo);
$query_anio_periodo->execute();
$anio_periodo_datos = $query_anio_periodo->fetchAll(PDO::FETCH_ASSOC);