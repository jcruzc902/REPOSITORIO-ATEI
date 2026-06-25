<?php

include('../../config.php');

$id_cheque = $_POST['id_cheque'];
$nt = $_POST['nt'];
$id_anio_nt = $_POST['id_anio_nt'];
$proveido_diga = $_POST['proveido_diga'];
$fecha_proveido_diga = $_POST['fecha_proveido_diga'];
$proveido_conta = $_POST['proveido_conta'];
$fecha_proveido_conta = $_POST['fecha_proveido_conta'];
$informe = mb_strtoupper($_POST['informe']);
$fecha_informe = $_POST['fecha_informe'];
$id_asunto = $_POST['id_asunto'];
$id_tipo_gasto = $_POST['id_tipo_gasto'];
$oficio = mb_strtoupper($_POST['oficio']);
$fecha_oficio = $_POST['fecha_oficio'];
$observacion = mb_strtoupper($_POST['observacion']);
$id_usuario = $_POST['id_usuario'];


$sentencia = $pdo->prepare("UPDATE tb_cheque
    SET nt=:nt,
    id_anio_nt=:id_anio_nt,
    proveido_diga=:proveido_diga,
    fecha_diga=:fecha_diga,
    proveido_conta=:proveido_conta,
    fecha_conta=:fecha_conta,
    informe=:informe,
    fecha_informe=:fecha_informe,
    id_asunto=:id_asunto,
    id_tipo_gasto=:id_tipo_gasto,
    oficio=:oficio,
    fecha_oficio=:fecha_oficio,
    observacion=:observacion,
    id_usuario=:id_usuario,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_cheque = :id_cheque ");

$sentencia->bindParam('nt', $nt);
$sentencia->bindParam('id_anio_nt', $id_anio_nt);
$sentencia->bindParam('proveido_diga', $proveido_diga);
$sentencia->bindParam('fecha_diga', $fecha_proveido_diga);
$sentencia->bindParam('proveido_conta', $proveido_conta);
$sentencia->bindParam('fecha_conta', $fecha_proveido_conta);
$sentencia->bindParam('informe', $informe);
$sentencia->bindParam('fecha_informe', $fecha_informe);
$sentencia->bindParam('id_asunto', $id_asunto);
$sentencia->bindParam('id_tipo_gasto', $id_tipo_gasto);
$sentencia->bindParam('oficio', $oficio);
$sentencia->bindParam('fecha_oficio', $fecha_oficio);
$sentencia->bindParam('observacion', $observacion);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_cheque', $id_cheque);
$sentencia->execute();

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo los datos del cheque de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/cheques/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/cheques/update.php?id=' . $id_cheque);
}







