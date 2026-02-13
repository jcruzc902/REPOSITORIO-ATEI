<?php

include ('../app/config.php');

$clasificador_mef = $_GET['clasificador_mef'];

$sql_clasificador_mef = "SELECT descripcion_mef FROM tb_clasificador_mef where clasificador_mef='$clasificador_mef' AND visible!=1";
$query_clasificador_mef = $pdo->prepare($sql_clasificador_mef);
$query_clasificador_mef->execute();
$clasificador_mef_datos = $query_clasificador_mef->fetchAll(PDO::FETCH_ASSOC);

foreach($clasificador_mef_datos as $clasificador_mef_dato){
    echo json_encode($clasificador_mef_dato);
}


?>