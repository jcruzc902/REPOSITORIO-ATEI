<?php

include('../../config.php');


$id_ingresos = $_POST['id_ingresos'];
$mes = $_POST['mes'];
$anio = $_POST['anio'];
$fecha = $_POST['fecha'];
$clasificador = $_POST['clasificador'];
$importe = $_POST['importe'];
$importe= str_replace(",","",$importe); //reemplazo la coma por vacio
$importe= str_replace("'","",$importe); //reemplaza el millar por vacio
$importe = floatval($importe);
$importe = number_format($importe, 2, '.', ''); //convertir int a decimal
$siic = $_POST['siic'];
$siaf = $_POST['siaf'];
$dependencia = $_POST['dependencia'];
$detalle = $_POST['detalle'];
$nro_recibo = $_POST['nro_recibo'];
$banco = $_POST['banco'];
$cuenta = $_POST['cuenta'];
$nombre = $_POST['nombre'];
$estado = $_POST['estado'];
$id_usuario = $_POST['id_usuario'];

if($cuenta!="300152-18"){
    $nombre="";
}


$sentencia = $pdo->prepare("UPDATE tb_conciliacion_bancaria 
    SET mes_ingresos=:mes_ingresos,
    anio_ingresos=:anio_ingresos,
    fecha_ingresos=:fecha_ingresos,
    clasificador_ingresos=:clasificador_ingresos,
    importe_ingresos=:importe_ingresos,
    siic_ingresos=:siic_ingresos,
    siaf_ingresos=:siaf_ingresos,
    dependencia_ingresos=:dependencia_ingresos,
    detalle_ingresos=:detalle_ingresos,
    nro_recibo=:nro_recibo,
    banco_ingresos=:banco_ingresos,
    cta_ingresos=:cta_ingresos,
    nombre_ingresos=:nombre_ingresos,
    estado=:estado,
    id_usuario=:id_usuario,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_ingresos = :id_ingresos ");

$sentencia->bindParam('mes_ingresos', $mes);
$sentencia->bindParam('anio_ingresos', $anio);
$sentencia->bindParam('fecha_ingresos', $fecha);
$sentencia->bindParam('clasificador_ingresos', $clasificador);
$sentencia->bindParam('importe_ingresos', $importe);
$sentencia->bindParam('siic_ingresos', $siic);
$sentencia->bindParam('siaf_ingresos', $siaf);
$sentencia->bindParam('dependencia_ingresos', $dependencia);
$sentencia->bindParam('detalle_ingresos', $detalle);
$sentencia->bindParam('nro_recibo', $nro_recibo);
$sentencia->bindParam('banco_ingresos', $banco);
$sentencia->bindParam('cta_ingresos', $cuenta);
$sentencia->bindParam('nombre_ingresos', $nombre);
$sentencia->bindParam('estado', $estado);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_ingresos', $id_ingresos);
$sentencia->execute();





if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo los datos del ingreso de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/conciliacion_bancaria/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/conciliacion_bancaria/update.php?id=' . $id_ingresos);
}











