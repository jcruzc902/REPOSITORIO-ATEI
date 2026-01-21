<?php

include ('../../config.php');

$id_detalle_cheque = $_POST['id_detalle_cheque'];
$id_usuario = $_POST['id_usuario'];
$id_nrocuenta = $_POST['id_nrocuenta'];
$nro_ci = $_POST['nro_comprobante_interno'];
$fecha_ci = $_POST['fecha_comprobante_interno'];
$nro_ce = $_POST['nro_comprobante_externo'];
$fecha_ce = $_POST['fecha_comprobante_externo'];
$nro_cheque = $_POST['numero_cheque'];
$fecha_emision_cheque = $_POST['fecha_emision_cheque'];
$siaf = $_POST['siaf'];
$monto = $_POST['monto'];
$nro_envio = $_POST['numero_envio'];
$fecha_aprobado = $_POST['fecha_aprobado'];
$fecha_entregado = $_POST['fecha_entregado'];
$fecha_pagado = $_POST['fecha_pagado'];
$estado_cheque = $_POST['id_estado_cheque'];
$id_asunto= $_POST['id_asunto'];
$observacion = mb_strtoupper($_POST['observacion']);
$id_cheque = $_POST['id_cheque'];


$sentencia = $pdo->prepare("UPDATE tb_detalle_cheque
    SET id_nrocuenta=:id_nrocuenta,
    nro_ci=:nro_ci,
    fecha_ci=:fecha_ci,
    nro_ce=:nro_ce,
    fecha_ce=:fecha_ce,
    nro_cheque=:nro_cheque,
    fecha_emision_cheque=:fecha_emision_cheque,
    siaf=:siaf,
    monto=:monto,
    nro_envio=:nro_envio,
    fecha_aprobado=:fecha_aprobado,
    fecha_entregado=:fecha_entregado,
    fecha_pagado=:fecha_pagado,
    id_estado_cheque=:id_estado_cheque,
    observacion=:observacion,
    id_usuario=:id_usuario,
    id_cheque=:id_cheque,
    id_asunto=:id_asunto,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_detalle_cheque = :id_detalle_cheque");

$sentencia->bindParam('id_nrocuenta', $id_nrocuenta);
$sentencia->bindParam('nro_ci', $nro_ci);
$sentencia->bindParam('fecha_ci', $fecha_ci);
$sentencia->bindParam('nro_ce', $nro_ce);
$sentencia->bindParam('fecha_ce', $fecha_ce);
$sentencia->bindParam('nro_cheque', $nro_cheque);
$sentencia->bindParam('fecha_emision_cheque', $fecha_emision_cheque);
$sentencia->bindParam('siaf', $siaf);
$sentencia->bindParam('monto', $monto);
$sentencia->bindParam('nro_envio', $nro_envio);
$sentencia->bindParam('fecha_aprobado', $fecha_aprobado);
$sentencia->bindParam('fecha_entregado', $fecha_entregado);
$sentencia->bindParam('fecha_pagado', $fecha_pagado);
$sentencia->bindParam('id_estado_cheque', $estado_cheque);
$sentencia->bindParam('observacion', $observacion);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('id_cheque', $id_cheque);
$sentencia->bindParam('id_asunto', $id_asunto);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_detalle_cheque', $id_detalle_cheque);
$sentencia->execute();

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo los datos del cheque de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/detalle_cheque/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/detalle_cheque/update.php?id=' . $id_devolucion_dinero);
}







