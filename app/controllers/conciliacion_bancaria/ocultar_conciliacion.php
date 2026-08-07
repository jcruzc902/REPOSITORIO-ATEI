<?php
/**
 
 * Date: 20/1/2023
 * Time: 10:19
 */

include ('../../config.php');

$id_ingresos = $_POST['id_ingresos'];
$id_usuario= $_POST['id_usuario'];
$observacion_cb= mb_strtoupper($_POST['observacion_eliminar']);
$visible = 1;

/*OCULTA LOS DATOS DE LA CARTA FIANZA (NO ELIMINA)*/ 
$sentencia = $pdo->prepare("UPDATE tb_conciliacion_bancaria 
SET 
observacion=:observacion,
visible=:visible,
id_usuario=:id_usuario,
fyh_actualizacion=:fyh_actualizacion WHERE id_ingresos=:id_ingresos");

$sentencia->bindParam('observacion', $observacion_cb);
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_ingresos', $id_ingresos);
$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino el ingreso de la manera correcta";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/conciliacion_bancaria/');

