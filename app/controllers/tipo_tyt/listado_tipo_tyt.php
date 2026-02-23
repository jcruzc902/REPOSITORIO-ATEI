<?php

$sql_tipo_tyt = "SELECT * FROM tb_tipo_tyt where id_tipo_tyt!=1 ORDER BY nombre_tipo_tyt ASC";
$query_tipo_tyt = $pdo->prepare($sql_tipo_tyt);
$query_tipo_tyt->execute();
$tipo_tyt_datos = $query_tipo_tyt->fetchAll(PDO::FETCH_ASSOC);