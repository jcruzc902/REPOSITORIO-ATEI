<?php
/**
 
 * Date: 20/1/2023
 * Time: 10:19
 */

include ('../../config.php');
$observacion = mb_strtoupper($_POST['observacion']);
$id_egreso = $_POST['id_egreso'];
$id_usuario= $_POST['id_usuario'];
$visible = 1;


//----------------------------------------------------------------------------------------

/*OCULTA LOS DATOS DE EGRESOS (NO ELIMINA)*/ 
$sentencia = $pdo->prepare("UPDATE tb_egresos 
SET observacion_egreso=:observacion_egreso,
visible=:visible,
id_usuario=:id_usuario,
fyh_actualizacion=:fyh_actualizacion WHERE id_egresos=:id_egresos");

$sentencia->bindParam('observacion_egreso', $observacion);
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_egresos', $id_egreso);
$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino los datos del estado de egresos de la manera correcta";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/estado_egresos/');

