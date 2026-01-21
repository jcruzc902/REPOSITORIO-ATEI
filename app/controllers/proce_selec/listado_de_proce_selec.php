<?php

$sql_proce_selec_cf = "SELECT * FROM tb_proce_selec where id_proce_selec!=1";
$query_proce_selec_cf = $pdo->prepare($sql_proce_selec_cf);
$query_proce_selec_cf->execute();
$proce_selec_cf_datos = $query_proce_selec_cf->fetchAll(PDO::FETCH_ASSOC);