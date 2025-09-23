<?php

$sql_estado_egreso = "SELECT * FROM tb_estado_egreso WHERE id_estado_egreso!=1";
$query_estado_egreso = $pdo->prepare($sql_estado_egreso);
$query_estado_egreso->execute();
$estado_egreso_datos = $query_estado_egreso->fetchAll(PDO::FETCH_ASSOC);