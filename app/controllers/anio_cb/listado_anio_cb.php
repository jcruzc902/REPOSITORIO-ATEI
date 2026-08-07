<?php

$sql_anio_cb = "SELECT * FROM tb_anio_cb";
$query_anio_cb = $pdo->prepare($sql_anio_cb);
$query_anio_cb->execute();
$anio_cb_datos = $query_anio_cb->fetchAll(PDO::FETCH_ASSOC);