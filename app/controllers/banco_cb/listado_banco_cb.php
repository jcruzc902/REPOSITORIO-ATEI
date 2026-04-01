<?php

$sql_banco_cb = "SELECT * FROM tb_banco_cb where visible!=1 ORDER BY nombre_banco";
$query_banco_cb = $pdo->prepare($sql_banco_cb);
$query_banco_cb->execute();
$banco_cb_datos = $query_banco_cb->fetchAll(PDO::FETCH_ASSOC);