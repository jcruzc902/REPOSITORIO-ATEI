<?php
/**
 
 * Date: 20/1/2023
 * Time: 10:19
 */

include ('../../config.php');

$id_carta_fianza = $_POST['id_carta_fianza'];
$id_usuario= $_POST['id_usuario'];
$observacion_cf= mb_strtoupper($_POST['observacion_eliminar']);
$visible = 1;

/*OCULTA LOS DATOS DE LA CARTA FIANZA (NO ELIMINA)*/ 
$sentencia = $pdo->prepare("UPDATE tb_cartas_fianza 
SET 
observacion_cf=:observacion_cf,
visible=:visible,
id_usuario=:id_usuario,
fyh_actualizacion=:fyh_actualizacion WHERE id_carta_fianza=:id_carta_fianza");

$sentencia->bindParam('observacion_cf', $observacion_cf);
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_carta_fianza', $id_carta_fianza);
$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino la carta fianza de la manera correcta";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/cartas_fianza/');

