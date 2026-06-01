<?php

$sql_banco_ingresos = "SELECT * FROM tb_banco_ingresos where visible!=1 ORDER BY nombre_banco";
$query_banco_ingresos = $pdo->prepare($sql_banco_ingresos);
$query_banco_ingresos->execute();
$banco_ingresos_datos = $query_banco_ingresos->fetchAll(PDO::FETCH_ASSOC);