<?php
include ('../../config.php');
session_start();

$nt= $_GET['numero_tramite'];
$id_anio_nt= $_GET['anio_nt'];
$id_asunto= $_GET['asunto'];
$id_cheque= $_GET['id_cheque'];


$sql_anios = "SELECT * FROM tb_anio_nt WHERE id_anio_nt='$id_anio_nt'";
$query_anios = $pdo->prepare($sql_anios);
$query_anios->execute();
$anios_datos = $query_anios->fetchAll(PDO::FETCH_ASSOC);

foreach($anios_datos as $anios_dato){
    $anio_nt= $anios_dato['anio_nt'];
}

$_SESSION['numero_tramite_cheque'] = $nt;
$_SESSION['anio_nt_cheque']= $anio_nt;
$_SESSION['id_anio_nt_cheque'] = $id_anio_nt;
$_SESSION['id_asunto']= $id_asunto;
$_SESSION['id_cheque']= $id_cheque;





