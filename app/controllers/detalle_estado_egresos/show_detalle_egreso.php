<?php


$id_detalle_egreso = $_GET['id'];

$sql_detalle_egreso = "SELECT *,
t_detalle.fyh_creacion as fyh_creacion_egreso,
anios.anio_nt as anio_nt,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario 
FROM tb_detalle_egresos as t_detalle 
INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= t_detalle.id_usuario 
LEFT JOIN tb_anio_nt as anios ON  anios.id_anio_nt= t_detalle.id_anio_nt_principal 
WHERE t_detalle.visible!=1 AND t_detalle.id_detalle_egreso='$id_detalle_egreso'";
$query_detalle_egreso = $pdo->prepare($sql_detalle_egreso);
$query_detalle_egreso->execute();
$detalle_egreso_datos = $query_detalle_egreso->fetchAll(PDO::FETCH_ASSOC);

foreach ($detalle_egreso_datos as $detalle_egreso_dato) {
    $id_detalle_egreso = $detalle_egreso_dato['id_detalle_egreso'];
    $nt_principal = $detalle_egreso_dato['nt_principal'];
    $id_anio_nt_principal = $detalle_egreso_dato['id_anio_nt_principal'];
    $anio_nt_principal = $detalle_egreso_dato['anio_nt'];
    $nt_expediente = $detalle_egreso_dato['nt_expediente'];
    $id_anio_nt_expediente = $detalle_egreso_dato['id_anio_nt_expediente'];
    $proveido_contabilidad = $detalle_egreso_dato['proveido_contabilidad'];
    $fecha_contabilidad = $detalle_egreso_dato['fecha_contabilidad'];
    $proveido_diga = $detalle_egreso_dato['proveido_diga'];
    $fecha_diga = $detalle_egreso_dato['fecha_diga'];
    $oficio = $detalle_egreso_dato['oficio'];
    $fecha_oficio = $detalle_egreso_dato['fecha_oficio'];
    $resolucion = $detalle_egreso_dato['resolucion'];
    $fecha_resolucion = $detalle_egreso_dato['fecha_resolucion'];
    $especialidad = $detalle_egreso_dato['especialidad'];
    $n_oc = $detalle_egreso_dato['n_oc'];
    $n_os = $detalle_egreso_dato['n_os'];
    $siaf = $detalle_egreso_dato['siaf'];
    $monto = $detalle_egreso_dato['monto'];
    $egresos = $detalle_egreso_dato['egresos'];
    $ingresos = $detalle_egreso_dato['ingresos'];
    $nota_pago = $detalle_egreso_dato['nota_pago'];
    $fecha_giro = $detalle_egreso_dato['fecha_giro'];
    $estado_giro = $detalle_egreso_dato['estado_giro'];
    $observacion_giro = $detalle_egreso_dato['observacion_giro'];
    $fecha_pago = $detalle_egreso_dato['fecha_pago'];
    $informe_ingreso = $detalle_egreso_dato['informe_ingreso'];
    $fecha_informe_ingreso = $detalle_egreso_dato['fecha_informe_ingreso'];
    $documento = $detalle_egreso_dato['documento'];
    $fecha_documento = $detalle_egreso_dato['fecha_documento'];
    $tipo_pago = $detalle_egreso_dato['tipo_pago'];
    $detalle_pago = $detalle_egreso_dato['detalle_pago'];
    $periodo_pago = $detalle_egreso_dato['periodo_pago'];
    $checkbox_informe = $detalle_egreso_dato['checkbox_informe'];
    $informe = $detalle_egreso_dato['informe'];
    if($informe==0){
        $informe="";
    }
    $fecha_informe = $detalle_egreso_dato['fecha_informe'];
    $asunto_informe = $detalle_egreso_dato['asunto_informe'];
    $descripcion_informe = $detalle_egreso_dato['descripcion_informe'];
    $checkbox_ec = $detalle_egreso_dato['checkbox_ec'];
    $numero_estado_cuenta = $detalle_egreso_dato['numero_ec'];
    if($numero_estado_cuenta==0){
        $numero_estado_cuenta="";
    }
    $fecha_ec = $detalle_egreso_dato['fecha_ec'];
    $asunto_ec = $detalle_egreso_dato['asunto_ec'];
    $descripcion_ec = $detalle_egreso_dato['descripcion_ec'];
    $facultad = $detalle_egreso_dato['facultad'];
    $actividad_principal = $detalle_egreso_dato['actividad_principal'];
    $saldo_inicial = $detalle_egreso_dato['saldo_inicial'];
    $periodo_anio = $detalle_egreso_dato['periodo_anio'];
    $usuario = $detalle_egreso_dato['nombre_usuario'] . " " . $detalle_egreso_dato['apaterno_usuario'] . " " . $detalle_egreso_dato['amaterno_usuario'];
    $fecha_registro = $detalle_egreso_dato['fyh_creacion_egreso'];

}