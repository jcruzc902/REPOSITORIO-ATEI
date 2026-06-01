<?php

$sql_condicion_cf = "SELECT * FROM tb_condicion_cf where id_condicion_cf!=1";
$query_condicion_cf = $pdo->prepare($sql_condicion_cf);
$query_condicion_cf->execute();
$condicion_cf_datos = $query_condicion_cf->fetchAll(PDO::FETCH_ASSOC);