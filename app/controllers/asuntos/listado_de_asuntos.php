<?php

$sql_asuntos = "SELECT * FROM tb_asunto WHERE id_asunto!=1 ORDER BY nombre_asunto ASC";
$query_asuntos = $pdo->prepare($sql_asuntos);
$query_asuntos->execute();
$asuntos_datos = $query_asuntos->fetchAll(PDO::FETCH_ASSOC);