<?php

$sql_objeto_contratacion = "SELECT * FROM tb_objeto_contratacion where id_objeto_contratacion!=1 ORDER BY nombre_contratacion ASC";
$query_objeto_contratacion = $pdo->prepare($sql_objeto_contratacion);
$query_objeto_contratacion->execute();
$objeto_contratacion_datos = $query_objeto_contratacion->fetchAll(PDO::FETCH_ASSOC);