<?php

$sql_conceptos = "SELECT * FROM tb_conceptos where visible!=1 and id_concepto!=1 ORDER BY nombre ASC";
$query_conceptos = $pdo->prepare($sql_conceptos);
$query_conceptos->execute();
$conceptos_datos = $query_conceptos->fetchAll(PDO::FETCH_ASSOC);