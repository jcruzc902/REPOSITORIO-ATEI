<?php

/*
$sql_cta_cb = "SELECT * FROM tb_cta_cb where visible!=1 ORDER BY numero_cta";
$query_cta_cb = $pdo->prepare($sql_cta_cb);
$query_cta_cb->execute();
$cta_cb_datos = $query_cta_cb->fetchAll(PDO::FETCH_ASSOC);
*/

$sql_cta_cb = "SELECT cuenta.id_cta as id_cta,
cuenta.numero_cta as numero_cta,
banco_cb.id_banco as id_banco,
banco_cb.nombre_banco as nombre_banco 
FROM tb_cta_cb as cuenta 
INNER JOIN tb_banco_cb as banco_cb ON banco_cb.id_banco= cuenta.id_banco 
where cuenta.visible!=1 ORDER BY banco_cb.nombre_banco ASC";
$query_cta_cb = $pdo->prepare($sql_cta_cb);
$query_cta_cb->execute();
$cta_cb_datos = $query_cta_cb->fetchAll(PDO::FETCH_ASSOC);