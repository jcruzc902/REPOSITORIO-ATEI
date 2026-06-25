<?php

$sql_situacion_saldo = "SELECT * FROM tb_situacion_saldo where id_situacion_saldo!=1 ORDER BY nombre_situacion ASC";
$query_situacion_saldo = $pdo->prepare($sql_situacion_saldo);
$query_situacion_saldo->execute();
$situacion_saldo_datos = $query_situacion_saldo->fetchAll(PDO::FETCH_ASSOC);