<?php

$sql_modalidad_pago = "SELECT * FROM tb_modalidad_pago where id_modalidad_pago!=1 ORDER BY nombre_modalidad_pago ASC";
$query_modalidad_pago = $pdo->prepare($sql_modalidad_pago);
$query_modalidad_pago->execute();
$modalidad_pago_datos = $query_modalidad_pago->fetchAll(PDO::FETCH_ASSOC);