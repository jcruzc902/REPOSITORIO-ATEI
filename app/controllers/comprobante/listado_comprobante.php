<?php

$sql_comprobante = "SELECT * FROM tb_comprobantes where id_comprobantes!=1 ORDER BY nombre_comprobantes ASC";
$query_comprobante = $pdo->prepare($sql_comprobante);
$query_comprobante->execute();
$comprobante_datos = $query_comprobante->fetchAll(PDO::FETCH_ASSOC);