<?php
/**
 
 * Date: 20/1/2023
 * Time: 10:19
 */

include ('../../config.php');
$observacion = mb_strtoupper($_POST['observacion']);
$id_recaudacion = $_POST['id_recaudacion'];
$id_usuario= $_POST['id_usuario'];
$visible = 1;


//----------------------------------------------------------------------------------------

/*OCULTA LOS DATOS DE EGRESOS (NO ELIMINA)*/ 
$sentencia = $pdo->prepare("UPDATE tb_recaudacion_ingresos 
SET observacion=:observacion,
visible=:visible,
id_usuario=:id_usuario,
fyh_actualizacion=:fyh_actualizacion WHERE id_recaudacion=:id_recaudacion");

$sentencia->bindParam('observacion', $observacion);
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_recaudacion', $id_recaudacion);
$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino los datos de recaudacion de ingresos de la manera correcta";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/recaudacion_ingresos/');

