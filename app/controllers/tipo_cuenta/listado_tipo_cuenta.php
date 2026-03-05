<?php

$sql_tipo_cuenta = "SELECT * FROM tb_cuenta_saldo where id_cuenta_saldo!=1 ORDER BY cuenta_saldo ASC";
$query_tipo_cuenta = $pdo->prepare($sql_tipo_cuenta);
$query_tipo_cuenta->execute();
$tipo_cuenta_datos = $query_tipo_cuenta->fetchAll(PDO::FETCH_ASSOC);