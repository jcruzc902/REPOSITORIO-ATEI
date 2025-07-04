<?php

$sql_anio_siaforigen = "SELECT * FROM tb_anio_siaforigen WHERE id_anio_siaforigen!=1 ";
$query_anio_siaforigen = $pdo->prepare($sql_anio_siaforigen);
$query_anio_siaforigen->execute();
$anio_siaforigen_datos = $query_anio_siaforigen->fetchAll(PDO::FETCH_ASSOC);