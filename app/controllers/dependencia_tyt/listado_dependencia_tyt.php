<?php

$sql_dependencia_tyt = "SELECT * FROM tb_dependencias_tyt where id_dependencias_tyt!=1 AND visible!=1 ORDER BY nombre_dependencias_tyt ASC";
$query_dependencia_tyt = $pdo->prepare($sql_dependencia_tyt);
$query_dependencia_tyt->execute();
$dependencia_tyt_datos = $query_dependencia_tyt->fetchAll(PDO::FETCH_ASSOC);