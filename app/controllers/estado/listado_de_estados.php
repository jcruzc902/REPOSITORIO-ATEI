<?php

$sql_estados = "SELECT * FROM tb_estado";
$query_estados = $pdo->prepare($sql_estados);
$query_estados->execute();
$estados_datos = $query_estados->fetchAll(PDO::FETCH_ASSOC);