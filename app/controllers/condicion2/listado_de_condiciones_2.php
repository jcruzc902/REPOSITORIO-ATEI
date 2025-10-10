<?php

$sql_condiciones2 = "SELECT * FROM tb_condicion2 where id_condicion2!=1";
$query_condiciones2 = $pdo->prepare($sql_condiciones2);
$query_condiciones2->execute();
$condiciones2_datos = $query_condiciones2->fetchAll(PDO::FETCH_ASSOC);