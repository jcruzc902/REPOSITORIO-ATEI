<?php

$sql_bancos = "SELECT * FROM tb_bancos WHERE id_banco!=1 AND visible!=1 ORDER BY nombre_banco ASC";
$query_bancos = $pdo->prepare($sql_bancos);
$query_bancos->execute();
$bancos_datos = $query_bancos->fetchAll(PDO::FETCH_ASSOC);