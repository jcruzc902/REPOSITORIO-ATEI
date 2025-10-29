<?php

$sql_concepto_giro = "SELECT * FROM tb_concepto_giro where id_concepto_giro!=1 ORDER BY nombre_concepto_giro ASC";
$query_concepto_giro = $pdo->prepare($sql_concepto_giro);
$query_concepto_giro->execute();
$concepto_giro_datos = $query_concepto_giro->fetchAll(PDO::FETCH_ASSOC);