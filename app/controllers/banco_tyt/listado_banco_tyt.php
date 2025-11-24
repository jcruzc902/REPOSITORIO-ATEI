<?php

$sql_banco_tyt = "SELECT * FROM tb_banco_tyt where id_banco_tyt!=1 AND visible!=1 ORDER BY nombre_banco ASC";
$query_banco_tyt = $pdo->prepare($sql_banco_tyt);
$query_banco_tyt->execute();
$banco_tyt_datos = $query_banco_tyt->fetchAll(PDO::FETCH_ASSOC);