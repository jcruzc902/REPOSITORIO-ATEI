<?php

$sql_resolucion_egresos = "SELECT * FROM tb_resoluciones_egresos ORDER BY resolucion ASC";
$query_resolucion_egresos = $pdo->prepare($sql_resolucion_egresos);
$query_resolucion_egresos->execute();
$resolucion_egresos_datos = $query_resolucion_egresos->fetchAll(PDO::FETCH_ASSOC);