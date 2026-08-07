<?php
include ('../../config.php');
session_start();

$nt= $_GET['numero_tramite'];
$id_anio_nt= $_GET['anio_nt'];
$proveido= $_GET['proveido'];
$fecha_proveido= $_GET['fecha_proveido'];
$informe= $_GET['informe'];
$fecha_informe= $_GET['fecha_informe'];
$id_dependencia= $_GET['facultad'];

$sql_anios = "SELECT * FROM tb_anio_nt WHERE id_anio_nt='$id_anio_nt'";
$query_anios = $pdo->prepare($sql_anios);
$query_anios->execute();
$anios_datos = $query_anios->fetchAll(PDO::FETCH_ASSOC);

foreach($anios_datos as $anios_dato){
    $anio_nt= $anios_dato['anio_nt'];
}


$sql_dependencias = "SELECT * FROM tb_dependencias WHERE id_dependencia='$id_dependencia'";
$query_dependencias = $pdo->prepare($sql_dependencias);
$query_dependencias->execute();
$dependencias_datos = $query_dependencias->fetchAll(PDO::FETCH_ASSOC);

foreach($dependencias_datos as $dependencias_dato){
    $nombre_dependencia= $dependencias_dato['nombre'];
}


$_SESSION['numero_tramite'] = $nt;
$_SESSION['anio_nt']= $anio_nt;
$_SESSION['id_anio_nt'] = $id_anio_nt;
$_SESSION['proveido']= $proveido;
$_SESSION['fecha_proveido']= $fecha_proveido;
$_SESSION['informe']= $informe;
$_SESSION['fecha_informe']= $fecha_informe;
$_SESSION['dependencia']= $nombre_dependencia;





