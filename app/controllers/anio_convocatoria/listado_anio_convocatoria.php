<?php

$sql_anio_convocatoria = "SELECT * FROM tb_anio_convocatoria WHERE id_anio_convocatoria!=1 ";
$query_anio_convocatoria = $pdo->prepare($sql_anio_convocatoria);
$query_anio_convocatoria->execute();
$anio_convocatoria_datos = $query_anio_convocatoria->fetchAll(PDO::FETCH_ASSOC);