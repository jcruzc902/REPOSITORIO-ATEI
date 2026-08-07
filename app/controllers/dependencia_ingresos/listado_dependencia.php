<?php

$sql_dependencias_ing = "SELECT * FROM tb_dependencia_ingresos where visible!=1 ORDER BY nombre_dependencia ASC";
$query_dependencias_ing = $pdo->prepare($sql_dependencias_ing);
$query_dependencias_ing->execute();
$dependencias_ing_datos = $query_dependencias_ing->fetchAll(PDO::FETCH_ASSOC);