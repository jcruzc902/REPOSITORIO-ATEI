<?php
/**
 
 * Date: 20/1/2023
 * Time: 10:19
 */

include ('../../config.php');

$id_devolucion = $_POST['id_devolucion'];
$id_usuario= $_POST['id_usuario'];
$nt= $_POST['nt']; //nt
$anio_nt= $_POST['anio_nt']; //id_anio_nt
$observacion= mb_strtoupper($_POST['observacion_devolucion']);
$visible = 1;


//----------------------------------------------------------------------------------------

/*OCULTA LOS DATOS DE LA DEVOLUCION DE DINERO (NO ELIMINA)*/ 
$sentencia = $pdo->prepare("UPDATE tb_devoluciones 
SET 
observacion_devolucion=:observacion_devolucion,
visible=:visible,
id_usuario=:id_usuario,
fyh_actualizacion=:fyh_actualizacion WHERE id_devolucion=:id_devolucion");

$sentencia->bindParam('observacion_devolucion', $observacion);
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_devolucion', $id_devolucion);
$sentencia->execute();


//-----------------------------------------------------------------------------------------

/*OCULTA LOS DATOS DE INGRESOS DE PAGOS (NO ELIMINA)*/
$sentencia2 = $pdo->prepare("UPDATE tb_detalle_devolucion 
SET 
visible=:visible,
nt=:nt,
id_anio_nt=:id_anio_nt,
fyh_actualizacion=:fyh_actualizacion WHERE nt=:nt and id_anio_nt=:id_anio_nt");

$sentencia2->bindParam('visible', $visible);
$sentencia2->bindParam('id_usuario', $id_usuario);
$sentencia2->bindParam('fyh_actualizacion', $fechaHora);
$sentencia2->bindParam('nt', $nt);
$sentencia2->bindParam('id_anio_nt', $anio_nt);
$sentencia2->execute();

session_start();
$_SESSION['mensaje'] = "Se elimino la devolucion de dinero de la manera correcta";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/devoluciones/');

