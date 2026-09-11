<?php

$sql_anios = "SELECT * FROM tb_anio_nt WHERE id_anio_nt!=1 ";
$query_anios = $pdo->prepare($sql_anios);
$query_anios->execute();
$anios_datos = $query_anios->fetchAll(PDO::FETCH_ASSOC);