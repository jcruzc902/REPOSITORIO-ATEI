<?php

$sql_concepto_tyt = "SELECT * FROM tb_concepto_tyt where id_concepto_tyt!=1 AND visible!=1 ORDER BY nombre_concepto_tyt ASC";
$query_concepto_tyt = $pdo->prepare($sql_concepto_tyt);
$query_concepto_tyt->execute();
$concepto_tyt_datos = $query_concepto_tyt->fetchAll(PDO::FETCH_ASSOC);