<?php

$sql_situacion_tyt = "SELECT * FROM tb_situacion_tyt where id_situacion_tyt!=1 ORDER BY nombre_situacion_tyt ASC";
$query_situacion_tyt = $pdo->prepare($sql_situacion_tyt);
$query_situacion_tyt->execute();
$situacion_tyt_datos = $query_situacion_tyt->fetchAll(PDO::FETCH_ASSOC);