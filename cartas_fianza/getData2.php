<?php

include ('../app/config.php');

$nombre_afianzador = $_GET['nombre_afianzador'];


$sql_afianzador = "SELECT ruc, estado FROM tb_afianzador_cf where nombre_afianzador='$nombre_afianzador' AND id_afianzador_cf!=1 AND visible!=1";
$query_afianzador = $pdo->prepare($sql_afianzador);
$query_afianzador->execute();
$afianzador_datos = $query_afianzador->fetchAll(PDO::FETCH_ASSOC);

foreach($afianzador_datos as $afianzador_dato){
    echo json_encode($afianzador_dato);
}



?>