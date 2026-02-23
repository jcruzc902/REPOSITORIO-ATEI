<?php

include ('../app/config.php');

$nombre_dependencia = $_GET['nombre_dependencia'];


$sql_entidades = "SELECT nombre_dependencias_tyt, codigo_facultad FROM tb_dependencias_tyt where nombre_dependencias_tyt='$nombre_dependencia' AND id_dependencias_tyt!=1 AND visible!=1";
$query_entidades = $pdo->prepare($sql_entidades);
$query_entidades->execute();
$entidades_datos = $query_entidades->fetchAll(PDO::FETCH_ASSOC);

foreach($entidades_datos as $entidades_dato){
    echo json_encode($entidades_dato);
}



?>