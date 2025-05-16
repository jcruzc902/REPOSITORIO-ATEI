<?php

$sql_estado_saldo = "SELECT * FROM tb_estado_saldo where id_estado_saldo!=1";
$query_estado_saldo = $pdo->prepare($sql_estado_saldo);
$query_estado_saldo->execute();
$estado_saldo_datos = $query_estado_saldo->fetchAll(PDO::FETCH_ASSOC);