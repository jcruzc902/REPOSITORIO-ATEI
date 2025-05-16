<?php

include ('../../config.php');

if ($_POST['id_dependencia'] == "") {
    $_POST['id_dependencia'] = "1";
}



$id_devolucion_dinero = $_POST['id_devolucion_dinero'];
$id_usuario = $_POST['id_usuario'];
$id_anio_periodo = $_POST['id_anio_periodo'];
$nt = $_POST['nt'];
$id_anio_nt = $_POST['id_anio_nt'];
$proveido = $_POST['proveido'];
$fecha_proveido = $_POST['fecha_proveido'];
$oficio = mb_strtoupper($_POST['oficio']);
$fecha_oficio = $_POST['fecha_oficio'];
$informe = $_POST['informe'];
$fecha_informe = $_POST['fecha_informe'];
$id_dependencia = $_POST['id_dependencia'];
$id_estado = $_POST['id_estado'];
$observacion= $_POST['observacion_devolucion'];


$sentencia = $pdo->prepare("UPDATE tb_devoluciones
    SET nt=:nt,
    proveido=:proveido,
    fecha_proveido=:fecha_proveido,
    oficio=:oficio,
    fecha_oficio=:fecha_oficio,
    informe=:informe,
    fecha_informe=:fecha_informe,
    observacion_devolucion=:observacion_devolucion,
    id_dependencia=:id_dependencia,
    id_estado_devolucion=:id_estado_devolucion,
    id_usuario=:id_usuario,
    id_anio_nt=:id_anio_nt,
    id_anio_periodo=:id_anio_periodo,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_devolucion = :id_devolucion ");

$sentencia->bindParam('nt', $nt);
$sentencia->bindParam('proveido', $proveido);
$sentencia->bindParam('fecha_proveido', $fecha_proveido);
$sentencia->bindParam('oficio', $oficio);
$sentencia->bindParam('fecha_oficio', $fecha_oficio);
$sentencia->bindParam('informe', $informe);
$sentencia->bindParam('fecha_informe', $fecha_informe);
$sentencia->bindParam('observacion_devolucion', $observacion);
$sentencia->bindParam('id_dependencia', $id_dependencia);
$sentencia->bindParam('id_estado_devolucion', $id_estado);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('id_anio_nt', $id_anio_nt);
$sentencia->bindParam('id_anio_periodo', $id_anio_periodo);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_devolucion', $id_devolucion_dinero);
$sentencia->execute();

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo los datos de la devolucion de dinero de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/devoluciones/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/devoluciones/update.php?id=' . $id_devolucion_dinero);
}







