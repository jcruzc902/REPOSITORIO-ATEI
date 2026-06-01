<?php


$id_carta_fianza = $_GET['id'];

$sql_carta_fianza = "SELECT *,
cf.fyh_creacion as fyh_creacioncf, 
us.id_usuario as id_usuario,
us.nombres as nombres_usuario,
us.apaterno as apellido_paterno,
us.amaterno as apellido_materno 
FROM tb_cartas_fianza as cf 
INNER JOIN tb_usuarios as us ON us.id_usuario= cf.id_usuario 
WHERE cf.visible!=1 AND cf.id_carta_fianza='$id_carta_fianza'";
$query_carta_fianza = $pdo->prepare($sql_carta_fianza);
$query_carta_fianza->execute();
$carta_fianza_datos = $query_carta_fianza->fetchAll(PDO::FETCH_ASSOC);

foreach ($carta_fianza_datos as $carta_fianza_dato) {
    $id_carta_fianza = $carta_fianza_dato["id_carta_fianza"];
    $periodo= $carta_fianza_dato["periodo"];
    $entidad_financiera= $carta_fianza_dato["entidad_financiera"];
    $ruc_entidad= $carta_fianza_dato["ruc_entidad"];
    $estado_entidad= $carta_fianza_dato["estado_entidad"];
    $nro_carta_fianza= $carta_fianza_dato["nro_carta_fianza"];
    $monto= $carta_fianza_dato["monto"];
    $codigo= $carta_fianza_dato["codigo"];
    $afianzador= $carta_fianza_dato["afianzador"];
    $ruc_afianzador= $carta_fianza_dato["ruc_afianzador"];
    $estado_afianzador= $carta_fianza_dato["estado_afianzador"];
    $objeto_contratacion= $carta_fianza_dato["objeto_contratacion"];
    $descripcion_objeto= $carta_fianza_dato["descripcion_objeto"];
    $tipo_seleccion= $carta_fianza_dato["tipo_seleccion"];
    $numero_seleccion= $carta_fianza_dato["numero_seleccion"];
    $anio_convocatoria= $carta_fianza_dato["anio_convocatoria"];
    $orden_servicio= $carta_fianza_dato["orden_servicio"];
    $orden_compra= $carta_fianza_dato["orden_compra"];
    $fecha_inicio= $carta_fianza_dato["fecha_inicio"];
    $fecha_termino= $carta_fianza_dato["fecha_termino"];
    $condicion= $carta_fianza_dato["condicion"];
    $observacion= $carta_fianza_dato["observacion"];
    $documento= $carta_fianza_dato["documento"];
    $fecha_documento= $carta_fianza_dato["fecha_documento"];
    $receptor= $carta_fianza_dato["receptor"];
    $nt_nro= $carta_fianza_dato["nt_nro"];
    $nt_anio= $carta_fianza_dato["nt_anio"];
    $observacion_nt= $carta_fianza_dato["observacion_nt"];
    $tipo_garantia= $carta_fianza_dato["tipo_garantia"];
    $id_usuario= $carta_fianza_dato["id_usuario"];
    $fyh_creacion= $carta_fianza_dato["fyh_creacioncf"];
    $usuario= $carta_fianza_dato["nombres_usuario"]." ".$carta_fianza_dato["apellido_paterno"]." ".$carta_fianza_dato["apellido_materno"];


}
