<?php

include ('../../config.php');

$id_usuario_sesion = $_POST['id_usuario'];
$id_recaudacion = $_POST['id_recaudacion'];
$dependencia = $_POST['dependencia'];
$detalle_concepto = mb_strtoupper($_POST['detalle_concepto']);
$banco = $_POST['banco'];
$cuenta = $_POST['cuenta'];
$fecha_recaudacion = $_POST['fecha_recaudacion'];
$nombre_encargado = mb_strtoupper($_POST['nombre_encargado']);
$documento_recepcion = mb_strtoupper($_POST['documento_recepcion']);
$monto_recaudado = $_POST['monto_recaudado'];
$monto_recaudado= str_replace(",","",$monto_recaudado); //reemplazo la coma por vacio
$monto_recaudado= str_replace("'","",$monto_recaudado); //reemplaza el millar por vacio
$monto_recaudado = floatval($monto_recaudado);
$monto_recaudado = number_format($monto_recaudado, 2, '.', ''); //convertir int a decimal

$banco_deposito = $_POST['banco_deposito'];
$cuenta_deposito = $_POST['cuenta_deposito'];
$fecha_deposito = $_POST['fecha_deposito'];
$nro_documento = $_POST['nro_documento'];
$importe = $_POST['importe'];
$importe= str_replace(",","",$importe); //reemplazo la coma por vacio
$importe= str_replace("'","",$importe); //reemplaza el millar por vacio
$importe = floatval($importe);
$importe = number_format($importe, 2, '.', ''); //convertir int a decimal

$nombre_depositante = mb_strtoupper($_POST['nombre_depositante']);
$numero_dni = $_POST['numero_dni'];
$numero_operacion = $_POST['numero_operacion'];
$estado = $_POST['estado'];




$sentencia = $pdo->prepare("UPDATE tb_recaudacion_ingresos 
    SET nombre_dependencia=:nombre_dependencia,
    detalle_concepto=:detalle_concepto,
    nombre_banco=:nombre_banco,
    fecha_recaudacion=:fecha_recaudacion,
    nombre_encargado=:nombre_encargado,
    documento_recepcion=:documento_recepcion,
    monto_recaudado=:monto_recaudado,
    nombre_banco2=:nombre_banco2,
    numero_cuenta2=:numero_cuenta2,
    fecha_deposito=:fecha_deposito,
    numero_documento=:numero_documento,
    importe=:importe,
    nombre_depositante=:nombre_depositante,
    dni=:dni,
    numero_operacion=:numero_operacion,
    estado=:estado,
    id_usuario=:id_usuario,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_recaudacion= :id_recaudacion");

$sentencia->bindParam('nombre_dependencia', $dependencia);
$sentencia->bindParam('detalle_concepto', $detalle_concepto);
$sentencia->bindParam('nombre_banco', $banco);
$sentencia->bindParam('fecha_recaudacion', $fecha_recaudacion);
$sentencia->bindParam('nombre_encargado', $nombre_encargado);
$sentencia->bindParam('documento_recepcion', $documento_recepcion);
$sentencia->bindParam('monto_recaudado', $monto_recaudado);
$sentencia->bindParam('nombre_banco2', $banco_deposito);
$sentencia->bindParam('numero_cuenta2', $cuenta_deposito);
$sentencia->bindParam('fecha_deposito', $fecha_deposito);
$sentencia->bindParam('numero_documento', $nro_documento);
$sentencia->bindParam('importe', $importe);
$sentencia->bindParam('nombre_depositante', $nombre_depositante);
$sentencia->bindParam('dni', $numero_dni);
$sentencia->bindParam('numero_operacion', $numero_operacion);
$sentencia->bindParam('estado', $estado);
$sentencia->bindParam('id_usuario', $id_usuario_sesion);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_recaudacion', $id_recaudacion);
$sentencia->execute();

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo los datos de recaudacion de ingreso de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/recaudacion_ingresos/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/recaudacion_ingresos/update.php?id=' . $id_recaudacion);
}