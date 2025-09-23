<?php

include ('../app/config.php');

$nombre_entidad = $_GET['nombre_entidad'];


$sql_entidades = "SELECT ruc, estado FROM tb_entidad_cf where nombre_entidad='$nombre_entidad' AND id_entidad_cf!=1 AND visible!=1";
$query_entidades = $pdo->prepare($sql_entidades);
$query_entidades->execute();
$entidades_datos = $query_entidades->fetchAll(PDO::FETCH_ASSOC);

foreach($entidades_datos as $entidades_dato){
    echo json_encode($entidades_dato);
}



?>