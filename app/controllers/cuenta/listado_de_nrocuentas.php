<?php

$sql_nrocuentas = "SELECT * FROM tb_nrocuenta where id_nrocuenta!=1 ";
$query_nrocuentas = $pdo->prepare($sql_nrocuentas);
$query_nrocuentas->execute();
$nrocuentas_datos = $query_nrocuentas->fetchAll(PDO::FETCH_ASSOC);