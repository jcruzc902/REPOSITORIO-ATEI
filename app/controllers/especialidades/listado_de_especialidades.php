<?php

$sql_especialidades = "SELECT * FROM tb_especialidades ORDER BY nombre_especialidad ASC";
$query_especialidades = $pdo->prepare($sql_especialidades);
$query_especialidades->execute();
$especialidades_datos = $query_especialidades->fetchAll(PDO::FETCH_ASSOC);