<?php

$sql_anio_envio = "SELECT * FROM tb_anio_envio WHERE id_anio_envio!=1 ";
$query_anio_envio = $pdo->prepare($sql_anio_envio);
$query_anio_envio->execute();
$anio_envio_datos = $query_anio_envio->fetchAll(PDO::FETCH_ASSOC);