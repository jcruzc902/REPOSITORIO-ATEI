<?php

$sql_docpagos = "SELECT * FROM tb_doc_pagos where id_doc_pagos!=1";
$query_docpagos = $pdo->prepare($sql_docpagos);
$query_docpagos->execute();
$docpagos_datos = $query_docpagos->fetchAll(PDO::FETCH_ASSOC);