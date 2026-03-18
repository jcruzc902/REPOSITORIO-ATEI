<?php


$id_detalle_tasas = $_GET['id'];

$sql_detalle_tasas = "SELECT tasas_tarifas.id_detalle_tyt as id_detalle_tyt,
tasas_tarifas.id_tasas_tarifas as id_tasas_tarifas,
tasas_tarifas.codigo_pago as codigo_pago,
tasas_tarifas.modalidad as modalidad,
tasas_tarifas.concepto as concepto,
tasas_tarifas.referencia as referencia,
tasas_tarifas.dependencia as dependencia,
tasas_tarifas.resolucion as resolucion,
tasas_tarifas.archivo as archivo,
tasas_tarifas.monto as monto,
tasas_tarifas.observacion as observacion,
tasas_tarifas.codigo_pago as codigo_pago,
estado_resolucion.nombre_estado_resolucion as estado_resolucion,
usuario.id_usuario as id_usuario,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario,
tasas_tarifas.fyh_creacion as fyh_creacion 
FROM tb_detalle_tyt as tasas_tarifas 
LEFT JOIN tb_usuarios as usuario ON usuario.id_usuario= tasas_tarifas.id_usuario
LEFT JOIN tb_estado_resolucion as estado_resolucion ON estado_resolucion.id_estado_resolucion= tasas_tarifas.id_estado_resolucion
WHERE tasas_tarifas.id_detalle_tyt='$id_detalle_tasas' AND tasas_tarifas.visible!=1";
$query_detalle_tasas = $pdo->prepare($sql_detalle_tasas);
$query_detalle_tasas->execute();
$detalle_tasas_datos = $query_detalle_tasas->fetchAll(PDO::FETCH_ASSOC);

foreach ($detalle_tasas_datos as $detalle_tasas_dato) {
    $id_detalle_tyt = $detalle_tasas_dato['id_detalle_tyt'];
    $id_tasas_tarifas = $detalle_tasas_dato['id_tasas_tarifas'];
    $codigo_pago = $detalle_tasas_dato['codigo_pago'];
    $modalidad = $detalle_tasas_dato['modalidad'];
    $concepto = $detalle_tasas_dato['concepto'];
    $referencia = $detalle_tasas_dato['referencia'];
    $dependencia = $detalle_tasas_dato['dependencia'];
    $resolucion = $detalle_tasas_dato['resolucion'];
    $archivo = $detalle_tasas_dato['archivo'];
    $monto = $detalle_tasas_dato['monto'];
    $monto= number_format($monto, 2, '.', ''); //convertir int a decimal
    $observacion = $detalle_tasas_dato['observacion'];
    $estado_resolucion = $detalle_tasas_dato['estado_resolucion'];
    $usuario = $detalle_tasas_dato['nombre_usuario'] . " " . $detalle_tasas_dato['apaterno_usuario'] . " " . $detalle_tasas_dato['amaterno_usuario'];
    $fecha_registro = $detalle_tasas_dato['fyh_creacion'];

}