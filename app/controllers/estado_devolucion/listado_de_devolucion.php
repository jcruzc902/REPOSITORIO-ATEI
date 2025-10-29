<?php

$sql_estado_devolucion = "SELECT * FROM tb_estado_devolucion WHERE id_estado_devolucion!=1";
$query_estado_devolucion = $pdo->prepare($sql_estado_devolucion);
$query_estado_devolucion->execute();
$estado_devolucion_datos = $query_estado_devolucion->fetchAll(PDO::FETCH_ASSOC);