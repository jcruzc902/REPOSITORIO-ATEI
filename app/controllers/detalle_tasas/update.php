<?php

include('../../config.php');


$monto = floatval($_POST["monto"]);
$monto = number_format($monto, 2, '.', '');
$estado = $_POST["id_estado_resolucion"];
$observacion = mb_strtoupper($_POST["observacion"]);
$visible = 0;
$usuario = $_POST["id_usuario"];
$id_tasas_tarifas = $_POST["id_tasas_tarifas"];
$id_detalle_tyt = $_POST["id_detalle_tyt"];

//si no sube ningun archivo

if ($_FILES["nuevo_archivo"]["name"] == null) {

    $sentencia = $pdo->prepare("UPDATE tb_detalle_tyt
    SET monto =:monto,
    observacion=:observacion,
    id_estado_resolucion =:id_estado_resolucion,
    id_usuario=:id_usuario,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_detalle_tyt = :id_detalle_tyt");

    $sentencia->bindParam('monto', $monto);
    $sentencia->bindParam('observacion', $observacion);
    $sentencia->bindParam('id_estado_resolucion', $estado);
    $sentencia->bindParam('id_usuario', $usuario);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_detalle_tyt', $id_detalle_tyt);
    $sentencia->execute();

} else {
    // Definir la carpeta de destino
    $carpeta_destino = "../detalle_tasas/files/";
    $nombre_archivo = basename($_FILES["nuevo_archivo"]["name"]);
    $nombre_archivo = mb_strtoupper($nombre_archivo); //convierte el nombre de archivo en mayusculas
    $nombre_archivo = str_replace('PDF', 'pdf', $nombre_archivo); //reemplaza PDF por pdf

    $nombre_resolucion = str_replace('.pdf', '', $nombre_archivo); //reemplaza .pdf en nulo

    // Mover el archivo a la carpeta de destino
    if (move_uploaded_file($_FILES["nuevo_archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
        //registro de datos con nuevo resolucion
        $sentencia3 = $pdo->prepare('INSERT INTO tb_resoluciones_tyt(nombre_resolucion_tyt,archivo,visible) 
        VALUES (:nombre_resolucion_tyt,:archivo,:visible)');

        $sentencia3->bindParam('nombre_resolucion_tyt', $nombre_resolucion);
        $sentencia3->bindParam('archivo', $nombre_archivo);
        $sentencia3->bindParam('visible', $visible);
        $sentencia3->execute();
    }

    $resolucion = $nombre_resolucion;
    $archivo_resolucion = $nombre_archivo;

    $sentencia = $pdo->prepare("UPDATE tb_detalle_tyt
    SET resolucion=:resolucion,
    archivo =:archivo,
    monto =:monto,
    observacion=:observacion,
    id_estado_resolucion =:id_estado_resolucion,
    id_tasas_tarifas=:id_tasas_tarifas,
    id_usuario=:id_usuario,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_detalle_tyt = :id_detalle_tyt");

    $sentencia->bindParam('resolucion', $resolucion);
    $sentencia->bindParam('archivo', $archivo_resolucion);
    $sentencia->bindParam('monto', $monto);
    $sentencia->bindParam('observacion', $observacion);
    $sentencia->bindParam('id_estado_resolucion', $estado);
    $sentencia->bindParam('id_tasas_tarifas', $id_tasas_tarifas);
    $sentencia->bindParam('id_usuario', $usuario);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_detalle_tyt', $id_detalle_tyt);
    $sentencia->execute();
}




if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo los datos de la resolucion de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/detalle_tasas/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/detalle_tasas/update.php?id=' . $id_detalle_tyt);
}







