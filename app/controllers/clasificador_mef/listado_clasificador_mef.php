<?php

$sql_clasificador_mef = "SELECT * FROM tb_clasificador_mef where visible!=1 ORDER BY clasificador_mef";
$query_clasificador_mef = $pdo->prepare($sql_clasificador_mef);
$query_clasificador_mef->execute();
$clasificador_mef_datos = $query_clasificador_mef->fetchAll(PDO::FETCH_ASSOC);