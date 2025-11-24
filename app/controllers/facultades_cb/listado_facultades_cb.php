<?php

$sql_facultades_cb = "SELECT * FROM tb_facultades_cb where visible!=1 ORDER BY nombre_facultad";
$query_facultades_cb = $pdo->prepare($sql_facultades_cb);
$query_facultades_cb->execute();
$facultades_cb_datos = $query_facultades_cb->fetchAll(PDO::FETCH_ASSOC);