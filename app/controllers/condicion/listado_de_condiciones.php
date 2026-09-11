<?php

$sql_condiciones = "SELECT * FROM tb_condicion where id_condicion!=1";
$query_condiciones = $pdo->prepare($sql_condiciones);
$query_condiciones->execute();
$condiciones_datos = $query_condiciones->fetchAll(PDO::FETCH_ASSOC);