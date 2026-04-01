<?php

$sql_estado_conciliacion = "SELECT * FROM tb_estado_conciliacion WHERE id_estado_conciliacion!=1";
$query_estado_conciliacion = $pdo->prepare($sql_estado_conciliacion);
$query_estado_conciliacion->execute();
$estado_conciliacion_datos = $query_estado_conciliacion->fetchAll(PDO::FETCH_ASSOC);