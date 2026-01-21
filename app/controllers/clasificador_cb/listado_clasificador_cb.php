<?php

$sql_clasificador_cb = "SELECT * FROM tb_clasificador_cb where visible!=1 ORDER BY clasificador_cb";
$query_clasificador_cb = $pdo->prepare($sql_clasificador_cb);
$query_clasificador_cb->execute();
$clasificador_cb_datos = $query_clasificador_cb->fetchAll(PDO::FETCH_ASSOC);