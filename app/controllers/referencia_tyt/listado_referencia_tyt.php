<?php

$sql_referencia_tyt = "SELECT * FROM tb_referencias_tyt where id_referencia_tyt!=1 AND visible!=1 ORDER BY nombre_referencia ASC";
$query_referencia_tyt = $pdo->prepare($sql_referencia_tyt);
$query_referencia_tyt->execute();
$referencia_tyt_datos = $query_referencia_tyt->fetchAll(PDO::FETCH_ASSOC);