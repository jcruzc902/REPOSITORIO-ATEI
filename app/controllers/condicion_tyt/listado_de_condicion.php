<?php

$sql_condicion_tyt = "SELECT * FROM tb_condicion_tyt";
$query_condicion_tyt = $pdo->prepare($sql_condicion_tyt);
$query_condicion_tyt->execute();
$condicion_tyt_datos = $query_condicion_tyt->fetchAll(PDO::FETCH_ASSOC);