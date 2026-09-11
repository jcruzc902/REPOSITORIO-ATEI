<?php

#puede ser anio periodo falla
$id_recaudacion = $_GET['id'];

$sql_recaudacion_ingresos = "SELECT recaudacion_ingresos.id_recaudacion as id_recaudacion,
    recaudacion_ingresos.nombre_dependencia as nombre_dependencia,
    recaudacion_ingresos.detalle_concepto as detalle_concepto,
    recaudacion_ingresos.nombre_banco as nombre_banco,
    recaudacion_ingresos.numero_cuenta as numero_cuenta,
    recaudacion_ingresos.fecha_recaudacion as fecha_recaudacion,
    recaudacion_ingresos.nombre_encargado as nombre_encargado,
    recaudacion_ingresos.documento_recepcion as documento_recepcion,
    recaudacion_ingresos.monto_recaudado as monto_recaudado,
    recaudacion_ingresos.nombre_banco2 as nombre_banco2,
    recaudacion_ingresos.numero_cuenta2 as numero_cuenta2,
    recaudacion_ingresos.fecha_deposito as fecha_deposito,
    recaudacion_ingresos.numero_documento as numero_documento,
    recaudacion_ingresos.importe as importe,
    recaudacion_ingresos.nombre_depositante as nombre_depositante,
    recaudacion_ingresos.dni as dni,
    recaudacion_ingresos.numero_operacion as numero_operacion,
    recaudacion_ingresos.estado as estado_recaudacion,
    recaudacion_ingresos.observacion as observacion,
    usuarios.id_usuario as id_usuario,
    usuarios.nombres as nombres,
    usuarios.apaterno as apaterno,
    usuarios.amaterno as amaterno,
    recaudacion_ingresos.fyh_creacion as fecha_creacion
    FROM tb_recaudacion_ingresos as recaudacion_ingresos 
    LEFT JOIN tb_usuarios as usuarios ON usuarios.id_usuario = recaudacion_ingresos.id_usuario
    WHERE recaudacion_ingresos.id_recaudacion='$id_recaudacion'";
$query_recaudacion_ingresos = $pdo->prepare($sql_recaudacion_ingresos);
$query_recaudacion_ingresos->execute();
$recaudacion_ingresos_datos = $query_recaudacion_ingresos->fetchAll(PDO::FETCH_ASSOC);

foreach ($recaudacion_ingresos_datos as $recaudacion_ingresos_dato) {
    $id_recaudacion = $recaudacion_ingresos_dato["id_recaudacion"];
    $nombre_dependencia = $recaudacion_ingresos_dato["nombre_dependencia"];
    $detalle_concepto = $recaudacion_ingresos_dato["detalle_concepto"];
    $nombre_banco = $recaudacion_ingresos_dato["nombre_banco"];
    $numero_cuenta = $recaudacion_ingresos_dato["numero_cuenta"];
    $fecha_recaudacion = $recaudacion_ingresos_dato["fecha_recaudacion"];
    $nombre_encargado = $recaudacion_ingresos_dato["nombre_encargado"];
    $documento_recepcion = $recaudacion_ingresos_dato["documento_recepcion"];
    $monto_recaudado = $recaudacion_ingresos_dato["monto_recaudado"];
    $nombre_banco2 = $recaudacion_ingresos_dato["nombre_banco2"];
    $numero_cuenta2 = $recaudacion_ingresos_dato["numero_cuenta2"];
    $fecha_deposito = $recaudacion_ingresos_dato["fecha_deposito"];
    $numero_documento = $recaudacion_ingresos_dato["numero_documento"];
    $importe = $recaudacion_ingresos_dato["importe"];
    $nombre_depositante = $recaudacion_ingresos_dato["nombre_depositante"];
    $dni = $recaudacion_ingresos_dato["dni"];
    $numero_operacion = $recaudacion_ingresos_dato["numero_operacion"];
    $estado_recaudacion = $recaudacion_ingresos_dato["estado_recaudacion"];
    $observacion = $recaudacion_ingresos_dato["observacion"];
    $nombre_depositante = $recaudacion_ingresos_dato["nombre_depositante"];
    $fyh_creacion = $recaudacion_ingresos_dato["fecha_creacion"];
    $usuario = $recaudacion_ingresos_dato["nombres"].' '.$recaudacion_ingresos_dato["apaterno"].' '.$recaudacion_ingresos_dato["amaterno"];  

}
