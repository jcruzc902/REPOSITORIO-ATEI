<?php
/**
 
 * Date: 20/1/2023
 * Time: 10:19
 */

include ('../../config.php');

$observacion_detalle= mb_strtoupper($_POST['observacion_detalle']);
$id_detalle_egreso = $_POST['id_detalle_egreso'];
$id_usuario = $_POST['id_usuario'];
$visible = 1;



$sentencia = $pdo->prepare("UPDATE tb_detalle_egresos 
SET observacion_egreso=:observacion_egreso,
visible=:visible,
id_usuario=:id_usuario,
fyh_actualizacion=:fyh_actualizacion 
WHERE id_detalle_egreso=:id_detalle_egreso");

$sentencia->bindParam('observacion_egreso', $observacion_detalle);
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('id_detalle_egreso', $id_detalle_egreso);
$sentencia->execute();
session_start();
$_SESSION['mensaje'] = "Se elimino el detalle del estado de egreso de la manera correcta";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/detalle_estado_egresos/');

