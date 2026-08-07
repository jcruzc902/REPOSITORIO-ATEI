<?php

$sql_estado_tasas = "SELECT * FROM tb_estado_tasas where id_estado_tasas!=1";
$query_estado_tasas = $pdo->prepare($sql_estado_tasas);
$query_estado_tasas->execute();
$estado_tasas_datos = $query_estado_tasas->fetchAll(PDO::FETCH_ASSOC);