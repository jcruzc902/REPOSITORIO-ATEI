<?php

$sql_cta_cb = "SELECT * FROM tb_cta_cb where visible!=1 ORDER BY numero_cta";
$query_cta_cb = $pdo->prepare($sql_cta_cb);
$query_cta_cb->execute();
$cta_cb_datos = $query_cta_cb->fetchAll(PDO::FETCH_ASSOC);