<?php

$sql_proveedor_cf = "SELECT * FROM tb_proveedor_cf where id_proveedor_cf!=1 AND visible!=1 ORDER BY nombre_proveedor ASC";
$query_proveedor_cf = $pdo->prepare($sql_proveedor_cf);
$query_proveedor_cf->execute();
$proveedor_cf_datos = $query_proveedor_cf->fetchAll(PDO::FETCH_ASSOC);