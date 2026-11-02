<?php

#puede ser anio periodo falla
$id_saldo_bancario = $_GET['id'];

$sql_saldo_bancario = "SELECT saldo_banco.id_saldo_banco as id_saldo_banco,
    saldo_banco.nombre_banco as nombre_banco,
    saldo_banco.numero_cuenta as numero_cuenta,
    saldo_banco.nombre_cuenta as nombre_cuenta,
    cuenta_saldo.id_cuenta_saldo as id_cuenta_saldo,
    cuenta_saldo.cuenta_saldo as cuenta_saldo,
    saldo_banco.fecha as fecha,
    saldo_banco.monto as monto_saldo,
    situacion_saldo.id_situacion_saldo as id_situacion_saldo,
    situacion_saldo.nombre_situacion as nombre_situacion,
    saldo_banco.detalle_cuenta as detalle_cuenta,
    estado_saldo.id_estado_saldo as id_estado_saldo,
    estado_saldo.nombre_estado as nombre_estado,
    saldo_banco.observacion as observacion,
    usuarios.id_usuario as id_usuario,
    usuarios.nombres as nombres,
    usuarios.apaterno as apaterno,
    usuarios.amaterno as amaterno,
    saldo_banco.fyh_creacion as fyh_creacion
    FROM tb_saldo_banco as saldo_banco 
    LEFT JOIN tb_cuenta_saldo as cuenta_saldo ON cuenta_saldo.id_cuenta_saldo = saldo_banco.tipo_cuenta 
    LEFT JOIN tb_situacion_saldo as situacion_saldo ON situacion_saldo.id_situacion_saldo = saldo_banco.situacion 
    LEFT JOIN tb_estado_saldo as estado_saldo ON estado_saldo.id_estado_saldo = saldo_banco.estado 
    LEFT JOIN tb_usuarios as usuarios ON usuarios.id_usuario = saldo_banco.id_usuario
    WHERE saldo_banco.id_saldo_banco='$id_saldo_bancario'";
$query_saldo_bancario = $pdo->prepare($sql_saldo_bancario);
$query_saldo_bancario->execute();
$saldo_bancario_datos = $query_saldo_bancario->fetchAll(PDO::FETCH_ASSOC);

foreach ($saldo_bancario_datos as $saldo_bancario_dato) {
    $id_saldo_bancario = $saldo_bancario_dato["id_saldo_banco"];
    $nombre_banco = $saldo_bancario_dato["nombre_banco"];
    $numero_cuenta = $saldo_bancario_dato["numero_cuenta"];
    $nombre_cuenta = $saldo_bancario_dato["nombre_cuenta"];
    $id_cuenta_saldo = $saldo_bancario_dato["id_cuenta_saldo"];
    $cuenta_saldo = $saldo_bancario_dato["cuenta_saldo"];
    $fecha = $saldo_bancario_dato["fecha"];
    $monto_saldo = $saldo_bancario_dato["monto_saldo"];
    $id_situacion_saldo = $saldo_bancario_dato["id_situacion_saldo"];
    $nombre_situacion = $saldo_bancario_dato["nombre_situacion"];
    $detalle_cuenta = $saldo_bancario_dato["detalle_cuenta"];
    $id_estado_saldo = $saldo_bancario_dato["id_estado_saldo"];
    $nombre_estado = $saldo_bancario_dato["nombre_estado"];
    $observacion = $saldo_bancario_dato["observacion"];
    $fyh_creacion = $saldo_bancario_dato["fyh_creacion"];
    $id_usuario = $saldo_bancario_dato["id_usuario"];
    $usuario = $saldo_bancario_dato["nombres"].' '.$saldo_bancario_dato["apaterno"].' '.$saldo_bancario_dato["amaterno"];  

}
