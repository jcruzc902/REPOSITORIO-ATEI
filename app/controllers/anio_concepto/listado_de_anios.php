<?php

$sql_anios_conceptos = "SELECT * FROM tb_anio_concepto where id_anio_concepto!=1";
$query_anios_conceptos = $pdo->prepare($sql_anios_conceptos);
$query_anios_conceptos->execute();
$anios_conceptos_datos = $query_anios_conceptos->fetchAll(PDO::FETCH_ASSOC);