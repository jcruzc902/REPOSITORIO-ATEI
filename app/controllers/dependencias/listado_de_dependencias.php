<?php

$sql_dependencias = "SELECT * FROM tb_dependencias where visible!=1 and id_dependencia!=1 ORDER BY nombre ASC";
$query_dependencias = $pdo->prepare($sql_dependencias);
$query_dependencias->execute();
$dependencias_datos = $query_dependencias->fetchAll(PDO::FETCH_ASSOC);