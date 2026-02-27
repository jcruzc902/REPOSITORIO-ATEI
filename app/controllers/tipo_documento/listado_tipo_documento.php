<?php

$sql_tipo_documento = "SELECT * FROM tb_tipo_documento where id_tipo_documento!=1";
$query_tipo_documento = $pdo->prepare($sql_tipo_documento);
$query_tipo_documento->execute();
$tipo_documento_datos = $query_tipo_documento->fetchAll(PDO::FETCH_ASSOC);