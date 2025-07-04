<?php

include ('../../config.php');

$nombre_cargo = $_POST['nombre_cargo'];
$nombre_actividad_principal = $_POST['nombre_actividad_principal'];
$saldo_inicial= $_POST['saldo_inicial'];
$anio_periodo = $_POST['anio_periodo'];
$id_estado = $_POST['id_estado'];
$id_egreso = $_POST['id_egreso'];
$id_usuario = $_POST['id_usuario'];


$sentencia = $pdo->prepare("UPDATE tb_egresos
    SET cargo_facultad=:cargo_facultad,
    actividad_principal=:actividad_principal,
    saldo_inicial=:saldo_inicial,
    anio=:anio,
    id_estado=:id_estado,
    id_usuario=:id_usuario,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_egresos= :id_egresos");

$sentencia->bindParam('cargo_facultad', $nombre_cargo);
$sentencia->bindParam('actividad_principal', $nombre_actividad_principal);
$sentencia->bindParam('saldo_inicial', $saldo_inicial);
$sentencia->bindParam('anio', $anio_periodo);
$sentencia->bindParam('id_estado', $id_estado);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_egresos', $id_egreso);
$sentencia->execute();

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo los datos del estado de egresos de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/estado_egresos/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/estado_egresos/update.php?id=' . $id_egreso);
}







