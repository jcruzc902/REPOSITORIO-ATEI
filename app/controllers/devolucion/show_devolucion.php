<?php


$id_devolucion_get = $_GET['id'];

$sql_devoluciones = "SELECT 
dev.id_devolucion as id_devolucion_dinero,
anio_periodo.anio_periodo as periodo_anio,
dev.nt as numero_tramite,
dev.id_anio_nt as id_anio_nt,
anio_nt.anio_nt as nt_anio,
dev.proveido as proveido,
dev.fecha_proveido as fecha_proveido,
dev.oficio as oficio,
dev.fecha_oficio as fecha_oficio,
dev.informe as informe,
dev.fecha_informe as fecha_informe,
dev.observacion_devolucion as observacion,
dep.id_dependencia as id_dependencia,
estado_devolucion.nombre_estado_devolucion as nombre_estado_devolucion,
dep.nombre as dependencia,
us.id_usuario as id_usuario,
us.nombres as nombres_usuario,
us.apaterno as apellido_paterno,
us.amaterno as apellido_materno,
dev.fyh_creacion as fecha_registro 
FROM tb_devoluciones as dev 
INNER JOIN tb_dependencias as dep ON dep.id_dependencia = dev.id_dependencia 
INNER JOIN tb_usuarios as us ON us.id_usuario = dev.id_usuario 
INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt = dev.id_anio_nt 
INNER JOIN tb_anio_periodo as anio_periodo ON anio_periodo.id_anio_periodo = dev.id_anio_periodo 
LEFT JOIN tb_estado_devolucion as estado_devolucion ON estado_devolucion.id_estado_devolucion = dev.id_estado_devolucion 
WHERE dev.visible!=1 AND dev.id_devolucion='$id_devolucion_get'";
$query_devoluciones = $pdo->prepare($sql_devoluciones);
$query_devoluciones->execute();
$devolucion_datos = $query_devoluciones->fetchAll(PDO::FETCH_ASSOC);

foreach ($devolucion_datos as $devolucion_dato) {
    $id_devolucion = $devolucion_dato["id_devolucion_dinero"];
    $periodo_anio= $devolucion_dato["periodo_anio"];
    $numero_tramite= $devolucion_dato["numero_tramite"];
    $nt_anio= $devolucion_dato["nt_anio"];
    $proveido= $devolucion_dato["proveido"];
    $fecha_proveido= $devolucion_dato["fecha_proveido"];
    $oficio= $devolucion_dato["oficio"];
    $fecha_oficio= $devolucion_dato["fecha_oficio"];
    $observacion= $devolucion_dato["observacion"];
    $informe= $devolucion_dato["informe"];
    $fecha_informe  = $devolucion_dato["fecha_informe"];
    $id_dependencia= $devolucion_dato["id_dependencia"];
    $dependencia= $devolucion_dato["dependencia"];
    $estado_devolucion= $devolucion_dato["nombre_estado_devolucion"];
    $fecha_registro= $devolucion_dato["fecha_registro"];
    $id_anio_nt= $devolucion_dato["id_anio_nt"];
    $id_usuario= $devolucion_dato["id_usuario"];
    $usuario= $devolucion_dato["nombres_usuario"]." ".$devolucion_dato["apellido_paterno"]." ".$devolucion_dato["apellido_materno"];


}
