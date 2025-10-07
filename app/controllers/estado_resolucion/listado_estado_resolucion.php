<?php

$sql_estado_resolucion = "SELECT * FROM tb_estado_resolucion where id_estado_resolucion!=1";
$query_estado_resolucion = $pdo->prepare($sql_estado_resolucion);
$query_estado_resolucion->execute();
$estado_resolucion_datos = $query_estado_resolucion->fetchAll(PDO::FETCH_ASSOC);