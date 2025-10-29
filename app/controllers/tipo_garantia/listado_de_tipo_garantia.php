<?php

$sql_tipo_garantia_cf = "SELECT * FROM tb_tipo_garantia where id_tipo_garantia!=1";
$query_tipo_garantia_cf = $pdo->prepare($sql_tipo_garantia_cf);
$query_tipo_garantia_cf->execute();
$tipo_garantia_cf_datos = $query_tipo_garantia_cf->fetchAll(PDO::FETCH_ASSOC);