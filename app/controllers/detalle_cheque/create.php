<?php
/**
 
 * Date: 29/1/2023
 * Time: 22:50
 */
include ('../../config.php');

$contador = 0;
$saldo = 0;
$sql_detalle_cheque = "SELECT * FROM tb_detalle_cheque where visible!=1";
$query_detalle_cheque = $pdo->prepare($sql_detalle_cheque);
$query_detalle_cheque->execute();
$detalle_cheque_datos = $query_detalle_cheque->fetchAll(PDO::FETCH_ASSOC);

foreach ($_POST['id_nrocuenta'] as $key => $value) {

    /*DETECTA SI EXISTE DUPLICADO EN EL VALOR DE NUMERO DE CHEQUE EN LA BASE DE DATOS*/
    foreach ($detalle_cheque_datos as $detalle_cheque_dato) {
        if ($detalle_cheque_dato["nro_cheque"] == $_POST['numero_cheque'][$key]) {
            $numero_cheque = $_POST['numero_cheque'][$key];
            $contador = 1;
        }
    }

    $monto = floatval($_POST['monto'][$key]);
    $monto = number_format($monto, 2, '.', ''); //convertir int a decimal

    /*SI NO HAY DUPLICADOS EMPIEZA A REGISTRAR LOS DATOS MULTIPLES, CASO CONTRARIO EMITE UNA ALERTA DE ERROR*/
    if ($contador != 1) {

        $stmt = $pdo->prepare('INSERT INTO tb_detalle_cheque (id_nrocuenta,nro_ci,fecha_ci,nro_ce,fecha_ce,nro_cheque,fecha_emision_cheque,siaf,monto,
        nro_envio,fecha_aprobado,fecha_entregado,fecha_pagado,id_estado_cheque,observacion_anulado,observacion,id_usuario,id_cheque,nt,id_anio_nt,id_asunto,fyh_creacion) 
    VALUES (:id_nrocuenta,:nro_ci,:fecha_ci,:nro_ce,:fecha_ce,:nro_cheque,:fecha_emision_cheque,:siaf,:monto,:nro_envio,
        :fecha_aprobado,:fecha_entregado,:fecha_pagado,:id_estado_cheque,:observacion_anulado,:observacion,:id_usuario,:id_cheque,:nt,:id_anio_nt,:id_asunto,:fyh_creacion)');

        $stmt->execute([
            'id_nrocuenta' => $value,
            'nro_ci' => $_POST['nro_comprobante_interno'][$key],
            'fecha_ci' => $_POST['fecha_comprobante_interno'][$key],
            'nro_ce' => $_POST['nro_comprobante_externo'][$key],
            'fecha_ce' => $_POST['fecha_comprobante_externo'][$key],
            'nro_cheque' => $_POST['numero_cheque'][$key],
            'fecha_emision_cheque' => $_POST['fecha_emision_cheque'][$key],
            'siaf' => $_POST['siaf'][$key],
            'monto' => $monto,
            'nro_envio' => $_POST['numero_envio'][$key],
            'fecha_aprobado' => $_POST['fecha_aprobado'][$key],
            'fecha_entregado' => $_POST['fecha_entregado'][$key],
            'fecha_pagado' => $_POST['fecha_pagado'][$key],
            'id_estado_cheque' => $_POST['id_estado_cheque'][$key],
            'observacion_anulado' => mb_strtoupper($_POST['observacion_anulado'][$key]), //convierte a mayuscula
            'observacion' => "",
            'id_usuario' => $_POST['id_usuario'][$key],
            'id_cheque' => $_POST['id_cheque'][$key],
            'nt' => $_POST['nt'][$key],
            'id_anio_nt' => $_POST['id_anio_nt'][$key],
            'id_asunto' => $_POST['id_asunto'][$key],
            'fyh_creacion' => $fechaHora
        ]);

        $respuesta = 0;
    } else if ($contador == 1) {
        $respuesta = 1;
    } 
}

if ($respuesta == 0) {
    session_start();
    $_SESSION['mensaje'] = "Se registro el pago del cheque de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/detalle_cheque/index.php');
} else if ($respuesta == 1) {
    session_start();
    $_SESSION['mensaje'] = "Este numero de cheque " . $numero_cheque . " a sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/detalle_cheque/create.php');
} 







