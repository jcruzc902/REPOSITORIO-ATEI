<?php

$sql_observacion_cf = "SELECT * FROM tb_observacion_cf WHERE id_observacion_cf!=1 ";
$query_observacion_cf = $pdo->prepare($sql_observacion_cf);
$query_observacion_cf->execute();
$observacion_cf_datos = $query_observacion_cf->fetchAll(PDO::FETCH_ASSOC);