<?php

$sql_modalidad_tyt = "SELECT * FROM tb_modalidad_tyt where id_modalidad_tyt!=1 AND visible!=1 ORDER BY nombre_modalidad ASC";
$query_modalidad_tyt = $pdo->prepare($sql_modalidad_tyt);
$query_modalidad_tyt->execute();
$modalidad_tyt_datos = $query_modalidad_tyt->fetchAll(PDO::FETCH_ASSOC);