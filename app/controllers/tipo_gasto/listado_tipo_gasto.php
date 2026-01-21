<?php

$sql_tipo_gasto = "SELECT * FROM tb_tipo_gasto where id_tipo_gasto!=1";
$query_tipo_gasto = $pdo->prepare($sql_tipo_gasto);
$query_tipo_gasto->execute();
$tipo_gasto_datos = $query_tipo_gasto->fetchAll(PDO::FETCH_ASSOC);