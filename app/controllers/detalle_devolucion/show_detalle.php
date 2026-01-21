<?php


$id_detalle_devolucion = $_GET['id'];

$sql_detalle_devolucion = "SELECT *, 
tip_documento.nombre_documento as tipo_identificacion,
empresa.razon_social as nombre_empresa,
empresa.ruc as nro_ruc,
banco.nombre_banco as nombre_banco,
concepto.nombre as nombre_concepto,
ciclo.ciclo as nombre_ciclo,
anio_concepto.anio_concepto as anio_de_concepto,
anio_siafdevolucion.anio_siaf as anio_siafdevolucion,
anio_siaforigen.anio_siaf as anio_siaforigen,
nrocuenta.nro_cuenta as numero_cuenta,
anio_nt.id_anio_nt as anio_idnt,
anio_nt.anio_nt as anio_numerotramite,
t_detalle.fyh_creacion as fyh_creacion,
giro.estado as estado_giro,
docpago.nombre as nombre_docpago,
anio_envio.anio_envio as anioenvio,
condicion.condicion as condicion_entrega,
condicion2.condicion as condicion_pago,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario 
FROM tb_detalle_devolucion as t_detalle 
INNER JOIN tb_tipo_documento as tip_documento ON tip_documento.id_tipo_documento= t_detalle.id_tipo_documento 
INNER JOIN tb_empresas as empresa ON empresa.id_empresa = t_detalle.id_empresa 
INNER JOIN tb_bancos as banco ON banco.id_banco = t_detalle.id_banco 
INNER JOIN tb_conceptos as concepto ON concepto.id_concepto= t_detalle.id_concepto 
INNER JOIN tb_ciclos as ciclo ON ciclo.id_ciclo= t_detalle.id_ciclo_concepto 
INNER JOIN tb_anio_concepto as anio_concepto ON anio_concepto.id_anio_concepto= t_detalle.id_anio_concepto 
INNER JOIN tb_anio_siafdevolucion as anio_siafdevolucion ON anio_siafdevolucion.id_anio_siafdevolucion= t_detalle.id_anio_siaf_devolucion 
INNER JOIN tb_anio_siaforigen as anio_siaforigen ON anio_siaforigen.id_anio_siaforigen = t_detalle.id_anio_siaf_origen 
INNER JOIN tb_nrocuenta as nrocuenta ON nrocuenta.id_nrocuenta = t_detalle.id_nrocuenta
INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= t_detalle.id_usuario 
INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt= t_detalle.id_anio_nt 
INNER JOIN tb_estado_giro as giro ON giro.id_estado_giro= t_detalle.id_estado_giro 
INNER JOIN tb_doc_pagos as docpago ON docpago.id_doc_pagos= t_detalle.id_doc_pagos 
INNER JOIN tb_anio_envio as anio_envio ON anio_envio.id_anio_envio= t_detalle.id_anio_envio
INNER JOIN tb_condicion as condicion ON condicion.id_condicion= t_detalle.id_condicion
INNER JOIN tb_condicion2 as condicion2 ON condicion2.id_condicion2= t_detalle.id_condicion2    
WHERE t_detalle.visible!=1 AND t_detalle.id_detalle_devolucion='$id_detalle_devolucion'";
$query_detalle_devolucion = $pdo->prepare($sql_detalle_devolucion);
$query_detalle_devolucion->execute();
$detalle_devolucion_datos = $query_detalle_devolucion->fetchAll(PDO::FETCH_ASSOC);

foreach ($detalle_devolucion_datos as $detalle_devolucion_dato) {
    $id_detalle_devolucion = $detalle_devolucion_dato['id_detalle_devolucion'];
    $numero_liquidacion = $detalle_devolucion_dato['nro_liquidacion'];
    $nombre_banco = $detalle_devolucion_dato['nombre_banco'];
    $nro_cuenta_banco = $detalle_devolucion_dato['nro_cuenta_banco'];
    $importe_voucher = $detalle_devolucion_dato['importe_voucher'];

    $importe_voucher= number_format($importe_voucher, 2, '.', ''); //convertir int a decimal

    $fecha_voucher = $detalle_devolucion_dato['fecha_voucher'];
    $nombre_concepto = $detalle_devolucion_dato['nombre_concepto'];
    $anio_de_concepto = $detalle_devolucion_dato['anio_de_concepto'];
    $nombre_ciclo = $detalle_devolucion_dato['nombre_ciclo'];
    $clasificador = $detalle_devolucion_dato['clasificador'];
    $siaf_devolucion = $detalle_devolucion_dato['siaf_devolucion'];
    $anio_siafdevolucion = $detalle_devolucion_dato['anio_siafdevolucion'];
    $siaf_origen = $detalle_devolucion_dato['siaf_origen'];
    $anio_siaforigen = $detalle_devolucion_dato['anio_siaforigen'];
    $tipo_identificacion = $detalle_devolucion_dato['tipo_identificacion'];
    $dni = $detalle_devolucion_dato['dni'];
    $nombre_solicitante = $detalle_devolucion_dato['nombre_solicitante'];
    $dni_apoderado = $detalle_devolucion_dato['dni_apoderado'];
    $nombre_apoderado = $detalle_devolucion_dato['nombre_apoderado'];
    $nombre_empresa = $detalle_devolucion_dato['nombre_empresa'];
    $ruc = $detalle_devolucion_dato['ruc'];
    $telefono = $detalle_devolucion_dato['telefono'];
    $correo = $detalle_devolucion_dato['correo'];
    $importe_devolucion_unfv = $detalle_devolucion_dato['importe_devolucion_unfv'];

    $importe_devolucion_unfv= number_format($importe_devolucion_unfv, 2, '.', ''); //convertir int a decimal

    $importe_devolucion_bn = $detalle_devolucion_dato['importe_devolucion_bn'];

    $importe_devolucion_bn= number_format($importe_devolucion_bn, 2, '.', ''); //convertir int a decimal

    $numero_cuenta = $detalle_devolucion_dato['numero_cuenta'];
    $diferencia = $detalle_devolucion_dato['diferencia'];

    $diferencia= number_format($diferencia, 2, '.', ''); //convertir int a decimal

    $saldo = $detalle_devolucion_dato['saldo'];

    $saldo= number_format($saldo, 2, '.', ''); //convertir int a decimal

    $estado_giro = $detalle_devolucion_dato['estado_giro'];
    $observacion_giro = $detalle_devolucion_dato['observacion_giro'];
    $documento_pago = $detalle_devolucion_dato['nombre_docpago'];
    $numero_cheque = $detalle_devolucion_dato['numero_cheque'];
    $fecha_cheque = $detalle_devolucion_dato['fecha_cheque'];
    $numero_ope = $detalle_devolucion_dato['numero_ope'];
    $fecha_ope = $detalle_devolucion_dato['fecha_ope'];
    $numero_cci = $detalle_devolucion_dato['numero_cci'];
    $fecha_cci = $detalle_devolucion_dato['fecha_cci'];
    $numero_cartaorden = $detalle_devolucion_dato['numero_cartaorden'];
    $fecha_cartaorden = $detalle_devolucion_dato['fecha_cartaorden'];
    $numero_envio = $detalle_devolucion_dato['nro_envio'];
    $anio_envio = $detalle_devolucion_dato['anioenvio'];
    $numero_comprobanteinterno = $detalle_devolucion_dato['nci'];
    $numero_comprobanteexterno = $detalle_devolucion_dato['nce'];
    $fecha_entrega = $detalle_devolucion_dato['fecha_entrega'];
    $condicion_entrega = $detalle_devolucion_dato['condicion_entrega'];
    $fecha_pago = $detalle_devolucion_dato['fecha_pago'];
    $condicion_pago = $detalle_devolucion_dato['condicion_pago'];
    $observacion = $detalle_devolucion_dato['observacion'];
    $nt = $detalle_devolucion_dato['nt'];
    $anio_nt = $detalle_devolucion_dato['anio_numerotramite'];
    $usuario = $detalle_devolucion_dato['nombre_usuario'] . " " . $detalle_devolucion_dato['apaterno_usuario'] . " " . $detalle_devolucion_dato['amaterno_usuario'];
    $fecha_registro = $detalle_devolucion_dato['fyh_creacion'];

}