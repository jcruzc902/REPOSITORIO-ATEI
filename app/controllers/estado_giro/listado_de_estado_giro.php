<?php

$sql_estado_giro = "SELECT * FROM tb_estado_giro WHERE id_estado_giro!=1";
$query_estado_giro = $pdo->prepare($sql_estado_giro);
$query_estado_giro->execute();
$estado_giro_datos = $query_estado_giro->fetchAll(PDO::FETCH_ASSOC);