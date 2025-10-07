<?php

include ('../../config.php');

$id_usuario_sesion = $_POST['id_usuario'];
$id_saldo_bancario = $_POST['id_saldo_bancario'];
$banco = $_POST['banco'];
$cuenta = $_POST['cuenta'];
$nombre = $_POST['nombre'];
$id_tipo = $_POST['tipo'];
$id_situacion = $_POST['situacion'];
$detalle_cuenta = mb_strtoupper($_POST['detalle_cuenta']);
$fecha = $_POST['fecha'];
$monto = floatval($_POST['monto']);
$monto = number_format($monto,2,'.',''); //convertir int a decimal
$id_estado_saldo = $_POST['id_estado_saldo'];

$sentencia = $pdo->prepare("UPDATE tb_saldo_banco 
    SET nombre_banco=:nombre_banco,
    numero_cuenta=:numero_cuenta,
    nombre_cuenta=:nombre_cuenta,
    tipo_cuenta=:tipo_cuenta,
    situacion=:situacion,
    detalle_cuenta=:detalle_cuenta,
    fecha=:fecha,
    monto=:monto,
    estado=:estado,
    id_usuario=:id_usuario,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_saldo_banco= :id_saldo_banco");

$sentencia->bindParam('nombre_banco', $banco);
$sentencia->bindParam('numero_cuenta', $cuenta);
$sentencia->bindParam('nombre_cuenta', $nombre);
$sentencia->bindParam('tipo_cuenta', $id_tipo);
$sentencia->bindParam('situacion', $id_situacion);
$sentencia->bindParam('detalle_cuenta', $detalle_cuenta);
$sentencia->bindParam('fecha', $fecha);
$sentencia->bindParam('monto', $monto);
$sentencia->bindParam('estado', $id_estado_saldo);
$sentencia->bindParam('id_usuario', $id_usuario_sesion);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_saldo_banco', $id_saldo_bancario);
$sentencia->execute();

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo los datos del saldo bancario de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/saldos/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/saldos/update.php?id=' . $id_saldo_bancario);
}