<?php

$sql_ciclos = "SELECT * FROM tb_ciclos where id_ciclo!=1";
$query_ciclos = $pdo->prepare($sql_ciclos);
$query_ciclos->execute();
$ciclos_datos = $query_ciclos->fetchAll(PDO::FETCH_ASSOC);