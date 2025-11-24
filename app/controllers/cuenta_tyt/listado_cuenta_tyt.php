<?php

$sql_cuenta_tyt = "SELECT cuenta.id_cuenta_tyt as id_cuenta_tyt,
cuenta.numero_cuenta_tyt as numero_cuenta_tyt,
banco_tyt.id_banco_tyt as id_banco,
banco_tyt.nombre_banco as nombre_banco 
FROM tb_cuenta_tyt as cuenta 
INNER JOIN tb_banco_tyt as banco_tyt ON banco_tyt.id_banco_tyt= cuenta.id_banco 
where cuenta.id_cuenta_tyt!=1 AND cuenta.visible!=1 ORDER BY banco_tyt.nombre_banco ASC";
$query_cuenta_tyt = $pdo->prepare($sql_cuenta_tyt);
$query_cuenta_tyt->execute();
$cuenta_tyt_datos = $query_cuenta_tyt->fetchAll(PDO::FETCH_ASSOC);