<?php


$id_detalle_cheque = $_GET['id'];

$sql_detalle_cheque = "SELECT cheque.id_detalle_cheque as id_detalle_cheque,
cheque.id_nrocuenta as id_nrocuenta,
nrocuenta.nro_cuenta as nro_cuenta,
cheque.nro_ci as nro_ci,
cheque.fecha_ci as fecha_ci,
cheque.nro_ce as nro_ce,
cheque.fecha_ce as fecha_ce,
cheque.nro_cheque as nro_cheque,
cheque.fecha_emision_cheque as fecha_emision,
cheque.siaf as siaf,
cheque.monto as monto,
cheque.nro_envio as nro_envio,
cheque.fecha_aprobado as fecha_aprobado,
cheque.fecha_entregado as fecha_entregado,
cheque.fecha_pagado as fecha_pagado,
estado_cheque.nombre_estado_cheque as estado_cheque,
cheque.observacion as observacion,
usuario.id_usuario as id_usuario,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario,
cheque.nt as nt,
cheque.id_anio_nt as id_anio_nt,
anio_nt.anio_nt as anio_nt,
cheque.fyh_creacion as fyh_creacion 
FROM tb_detalle_cheque as cheque 
INNER JOIN tb_nrocuenta as nrocuenta ON nrocuenta.id_nrocuenta= cheque.id_nrocuenta 
INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= cheque.id_usuario 
INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt= cheque.id_anio_nt 
LEFT JOIN tb_estado_cheque as estado_cheque ON estado_cheque.id_estado_cheque = cheque.id_estado_cheque 
WHERE cheque.visible!=1 AND cheque.id_detalle_cheque='$id_detalle_cheque'";
$query_detalle_cheque = $pdo->prepare($sql_detalle_cheque);
$query_detalle_cheque->execute();
$detalle_cheque_datos = $query_detalle_cheque->fetchAll(PDO::FETCH_ASSOC);

foreach ($detalle_cheque_datos as $detalle_cheque_dato) {
    $id_detalle_cheque = $detalle_cheque_dato['id_detalle_cheque'];
    $id_nrocuenta = $detalle_cheque_dato['id_nrocuenta'];
    $nro_cuenta = $detalle_cheque_dato['nro_cuenta'];
    $nro_ci = $detalle_cheque_dato['nro_ci'];
    $fecha_ci = $detalle_cheque_dato['fecha_ci'];
    $nro_ce = $detalle_cheque_dato['nro_ce'];
    $fecha_ce = $detalle_cheque_dato['fecha_ce'];
    $nro_cheque = $detalle_cheque_dato['nro_cheque'];
    $fecha_emision_cheque = $detalle_cheque_dato['fecha_emision'];
    $siaf = $detalle_cheque_dato['siaf']; 
    $monto = $detalle_cheque_dato['monto'];

    $monto= number_format($monto, 2, '.', ''); //convertir int a decimal

    $nt = $detalle_cheque_dato['nt'];
    $id_anio_nt = $detalle_cheque_dato['id_anio_nt'];
    $anio_nt = $detalle_cheque_dato['anio_nt'];
    $usuario = $detalle_cheque_dato['nombre_usuario'] . " " . $detalle_cheque_dato['apaterno_usuario'] . " " . $detalle_cheque_dato['amaterno_usuario'];
    $nro_envio = $detalle_cheque_dato['nro_envio'];
    $fecha_aprobado = $detalle_cheque_dato['fecha_aprobado'];
    $fecha_entregado = $detalle_cheque_dato['fecha_entregado'];
    $fecha_pagado = $detalle_cheque_dato['fecha_pagado'];
    $estado_cheque = $detalle_cheque_dato['estado_cheque'];
    $observacion = $detalle_cheque_dato['observacion'];
    $fecha_registro = $detalle_cheque_dato['fyh_creacion'];

}