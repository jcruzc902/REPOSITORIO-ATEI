<?php
/**
 
 * Date: 20/1/2023
 * Time: 10:19
 */

include ('../../config.php');

$observacion_detalle= mb_strtoupper($_POST['observacion']);
$id_detalle_cheque = $_POST['id_detalle_cheque'];
$id_usuario = $_POST['id_usuario'];
$visible = 1;



$sentencia = $pdo->prepare("UPDATE tb_detalle_cheque 
SET 
observacion=:observacion,
visible=:visible,
id_usuario=:id_usuario,
fyh_actualizacion=:fyh_actualizacion 
WHERE id_detalle_cheque=:id_detalle_cheque");

$sentencia->bindParam('observacion', $observacion_detalle);
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('id_detalle_cheque', $id_detalle_cheque);
$sentencia->execute();
session_start();
$_SESSION['mensaje'] = "Se elimino el pago realizado de la manera correcta";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/detalle_cheque/');

