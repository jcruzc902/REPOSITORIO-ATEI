<?php

$sql_cod_servicio_banco = "SELECT * FROM tb_cod_servbnco WHERE id_cod_servbnco!=1 ORDER BY nombre_cod_servbnco ASC";
$query_cod_servicio_banco = $pdo->prepare($sql_cod_servicio_banco);
$query_cod_servicio_banco->execute();
$cod_servicio_banco_datos = $query_cod_servicio_banco->fetchAll(PDO::FETCH_ASSOC);