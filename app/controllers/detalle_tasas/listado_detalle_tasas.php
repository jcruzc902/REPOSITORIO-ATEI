<?php

if (isset($_SESSION['codigo_pago'])) {
    $codigo_pago = $_SESSION['codigo_pago'];
} else {
    $codigo_pago = "";
}

if (isset($_SESSION['modalidad'])) {
    $modalidad = $_SESSION['modalidad'];
} else {
    $modalidad = "";
}

if (isset($_SESSION['concepto'])) {
    $concepto = $_SESSION['concepto'];
} else {
    $concepto = "";
}

if (isset($_SESSION['referencia'])) {
    $referencia = $_SESSION['referencia'];
} else {
    $referencia = "";
}

if (isset($_SESSION['dependencia'])) {
    $dependencia = $_SESSION['dependencia'];
} else {
    $dependencia = "";
}

if (isset($_SESSION['id_tasas_tarifas'])) {
    $id_tasas_tarifas = $_SESSION['id_tasas_tarifas'];
} else {
    $id_tasas_tarifas = "";
}

$sql_resolucion_tyt = "SELECT tasas_tarifas.id_detalle_tyt as id_detalle_tyt,
tasas_tarifas.resolucion as resolucion,
tasas_tarifas.archivo as archivo,
tasas_tarifas.monto as monto,
tasas_tarifas.observacion as observacion,
tasas_tarifas.codigo_pago as codigo_pago,
tasas_tarifas.modalidad as modalidad,
tasas_tarifas.concepto as concepto,
tasas_tarifas.referencia as referencia,
estado_resolucion.nombre_estado_resolucion as estado_resolucion,
usuario.id_usuario as id_usuario,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario 
FROM tb_detalle_tyt as tasas_tarifas 
LEFT JOIN tb_usuarios as usuario ON usuario.id_usuario= tasas_tarifas.id_usuario
LEFT JOIN tb_estado_resolucion as estado_resolucion ON estado_resolucion.id_estado_resolucion= tasas_tarifas.id_estado_resolucion
WHERE tasas_tarifas.id_tasas_tarifas='$id_tasas_tarifas' AND tasas_tarifas.visible!=1";
$query_resolucion_tyt = $pdo->prepare($sql_resolucion_tyt);
$query_resolucion_tyt->execute();
$resolucion_tyt_datos = $query_resolucion_tyt->fetchAll(PDO::FETCH_ASSOC);