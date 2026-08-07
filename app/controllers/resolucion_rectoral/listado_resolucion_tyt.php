<?php

$sql_resolucion_tyt = "SELECT id_resoluciones_tyt, nombre_resolucion_tyt, archivo  FROM tb_resoluciones_tyt 
where id_resoluciones_tyt!=1 AND visible!=1 GROUP BY nombre_resolucion_tyt ORDER BY nombre_resolucion_tyt ASC";
$query_resolucion_tyt = $pdo->prepare($sql_resolucion_tyt);
$query_resolucion_tyt->execute();
$resolucion_tyt_datos = $query_resolucion_tyt->fetchAll(PDO::FETCH_ASSOC);