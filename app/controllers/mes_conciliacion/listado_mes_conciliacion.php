<?php

$sql_mes = "SELECT * FROM tb_mes_cb";
$query_mes = $pdo->prepare($sql_mes);
$query_mes->execute();
$mes_datos = $query_mes->fetchAll(PDO::FETCH_ASSOC);