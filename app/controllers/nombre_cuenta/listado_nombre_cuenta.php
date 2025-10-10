<?php

$sql_nombre_cuenta = "SELECT nombre_cuenta.id_nombre_cuenta as id_nombre_cuenta,
nombre_cuenta.nombre_cuenta as nombre_cuenta,
cuenta_tyt.id_cuenta_tyt as id_cuenta_tyt,
cuenta_tyt.numero_cuenta_tyt as numero_cuenta_tyt,
banco_tyt.nombre_banco as nombre_banco
FROM tb_nombre_cuenta as nombre_cuenta 
INNER JOIN tb_cuenta_tyt as cuenta_tyt ON cuenta_tyt.id_cuenta_tyt = nombre_cuenta.id_numero_cuenta  
LEFT JOIN tb_banco_tyt as banco_tyt ON banco_tyt.id_banco_tyt= cuenta_tyt.id_banco  
WHERE nombre_cuenta.id_nombre_cuenta!=1 AND nombre_cuenta.visible!=1 ORDER BY nombre_cuenta.nombre_cuenta ASC";
$query_nombre_cuenta = $pdo->prepare($sql_nombre_cuenta);
$query_nombre_cuenta->execute();
$nombre_cuenta_datos = $query_nombre_cuenta->fetchAll(PDO::FETCH_ASSOC);