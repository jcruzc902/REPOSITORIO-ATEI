<?php

$sql_empresas = "SELECT * FROM tb_empresas where id_empresa!=1 and visible!=1 ORDER BY razon_social ASC";
$query_empresas = $pdo->prepare($sql_empresas);
$query_empresas->execute();
$empresas_datos = $query_empresas->fetchAll(PDO::FETCH_ASSOC);