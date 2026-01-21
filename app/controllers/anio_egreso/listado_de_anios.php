<?php

$sql_anios_egreso = "SELECT * FROM tb_anio_egreso WHERE id_anio_egreso!=1 ";
$query_anios_egreso = $pdo->prepare($sql_anios_egreso);
$query_anios_egreso->execute();
$anios_egreso_datos = $query_anios_egreso->fetchAll(PDO::FETCH_ASSOC);