<?php

$sql_estado_cheque = "SELECT * FROM tb_estado_cheque WHERE id_estado_cheque!=1";
$query_estado_cheque = $pdo->prepare($sql_estado_cheque);
$query_estado_cheque->execute();
$estado_cheque_datos = $query_estado_cheque->fetchAll(PDO::FETCH_ASSOC);