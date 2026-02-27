<?php
/**

 * Date: 29/1/2023
 * Time: 22:50
 */


include('../../config.php');


$codigo_pago = $_POST["codigo_pago"];
$modalidad = $_POST["modalidad"];
$nuevo_concepto = mb_strtoupper($_POST["nuevo_concepto"]);
$abreviatura_concepto = mb_strtoupper($_POST["abreviatura_concepto"]);
$referencia = $_POST["referencia"];
$clasificador = mb_strtoupper($_POST["clasificador"]);
$codigo_facultad = mb_strtoupper($_POST["codigo_facultad"]);
$dependencia = $_POST["dependencia"];
$codigo_serv_banco = mb_strtoupper($_POST["codigo_serv_banco"]);
$banco = $_POST["banco"];
$cuenta = $_POST["cuenta"];
$vigencia = $_POST["vigencia"];
$situacion = $_POST["situacion"];
$tipo = $_POST["tipo"];
$id_tasas_tarifas = $_POST["id_tasas_tarifas"];
$estado = $_POST["estado"];
$clasificador_mef = $_POST["clasificador_mef"];
$descripcion_clasificador = $_POST["descripcion_clasificador"];
$condicion_tyt = $_POST["condicion_tyt"];
$observacion = mb_strtoupper($_POST["observacion"]);
$visible = 0;
$usuario = $_POST["id_usuario"];

//-------------------------------------------------------------------------------------------

//registro de datos con nuevo concepto
$sentencia2 = $pdo->prepare('INSERT INTO tb_concepto_tyt(nombre_concepto_tyt,visible) 
    VALUES (:nombre_concepto_tyt,:visible)');

$sentencia2->bindParam('nombre_concepto_tyt', $nuevo_concepto);
$sentencia2->bindParam('visible', $visible);
$sentencia2->execute();


//-------------------------------------------------------------------------------------------


//registro de datos con tasas y tarifas
$sentencia = $pdo->prepare('INSERT INTO tb_tasas_tarifas(codigo_pago,modalidad,concepto,abreviatura,referencia,clasificador,
codigo_facultad,dependencia,codigo_ser_banco,banco,cta,vigencia,situacion,categoria_transaccion,observacion,id_estado,clasificador_mef,descripcion_mef,condicion_tyt,visible,id_usuario,fyh_creacion) 
    VALUES (:codigo_pago,:modalidad,:concepto,:abreviatura,:referencia,:clasificador,:codigo_facultad,:dependencia,
    :codigo_ser_banco,:banco,:cta,:vigencia,:situacion,:categoria_transaccion,:observacion,:id_estado,:clasificador_mef,:descripcion_mef,:condicion_tyt,:visible,:id_usuario,:fyh_creacion)');

$sentencia->bindParam('codigo_pago', $codigo_pago);
$sentencia->bindParam('modalidad', $modalidad);
$sentencia->bindParam('concepto', $nuevo_concepto);
$sentencia->bindParam('abreviatura', $abreviatura_concepto);
$sentencia->bindParam('referencia', $referencia);
$sentencia->bindParam('clasificador', $clasificador);
$sentencia->bindParam('codigo_facultad', $codigo_facultad);
$sentencia->bindParam('dependencia', $dependencia);
$sentencia->bindParam('codigo_ser_banco', $codigo_serv_banco);
$sentencia->bindParam('banco', $banco);
$sentencia->bindParam('cta', $cuenta);
$sentencia->bindParam('vigencia', $vigencia);
$sentencia->bindParam('situacion', $situacion);
$sentencia->bindParam('categoria_transaccion', $tipo);
$sentencia->bindParam('observacion', $observacion);
$sentencia->bindParam('id_estado', $estado);
$sentencia->bindParam('clasificador_mef', $clasificador_mef);
$sentencia->bindParam('descripcion_mef', $descripcion_clasificador);
$sentencia->bindParam('condicion_tyt', $condicion_tyt);
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_usuario', $usuario);
$sentencia->bindParam('fyh_creacion', $fechaHora);
$sentencia->execute();

//-------------------------------------------------------------------------------------------

$monto = floatval($_POST["monto"]);
$monto = number_format($monto, 2, '.', '');
$estado = $_POST["id_estado_resolucion"];
$observacion = mb_strtoupper($_POST["observacion"]);
$visible = 0;
$usuario = $_POST["id_usuario"];


// Definir la carpeta de destino
$carpeta_destino = "../detalle_tasas/files/";
$nombre_archivo = basename($_FILES["nuevo_archivo"]["name"]);
$nombre_archivo = mb_strtoupper($nombre_archivo); //convierte el nombre de archivo en mayusculas
$nombre_archivo = str_replace('PDF', 'pdf', $nombre_archivo); //reemplaza PDF por pdf

$nombre_resolucion = str_replace('.pdf', '', $nombre_archivo); //reemplaza .pdf en nulo

// Mover el archivo a la carpeta de destino
if (move_uploaded_file($_FILES["nuevo_archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
    //registro de datos con nuevo resolucion
    $sentencia3 = $pdo->prepare('INSERT INTO tb_resoluciones_tyt(nombre_resolucion_tyt,archivo,visible) 
        VALUES (:nombre_resolucion_tyt,:archivo,:visible)');

    $sentencia3->bindParam('nombre_resolucion_tyt', $nombre_resolucion);
    $sentencia3->bindParam('archivo', $nombre_archivo);
    $sentencia3->bindParam('visible', $visible);
    $sentencia3->execute();
}

$resolucion = $nombre_resolucion;
$archivo_resolucion = $nombre_archivo;



//registro de datos con detalle tasas y tarifas
$sentencia4 = $pdo->prepare('INSERT INTO tb_detalle_tyt(resolucion,archivo,monto,observacion,codigo_pago,modalidad,concepto,referencia,dependencia,id_estado_resolucion,visible,id_tasas_tarifas,id_usuario,fyh_creacion) 
    VALUES (:resolucion,:archivo,:monto,:observacion,:codigo_pago,:modalidad,:concepto,:referencia,:dependencia,:id_estado_resolucion,:visible,:id_tasas_tarifas,:id_usuario,:fyh_creacion)');

$sentencia4->bindParam('resolucion', $resolucion);
$sentencia4->bindParam('archivo', $archivo_resolucion);
$sentencia4->bindParam('monto', $monto);
$sentencia4->bindParam('observacion', $observacion);
$sentencia4->bindParam('codigo_pago', $codigo_pago);
$sentencia4->bindParam('modalidad', $modalidad);
$sentencia4->bindParam('concepto', $nuevo_concepto);
$sentencia4->bindParam('referencia', $referencia);
$sentencia4->bindParam('dependencia', $dependencia);
$sentencia4->bindParam('id_estado_resolucion', $estado);
$sentencia4->bindParam('visible', $visible);
$sentencia4->bindParam('id_tasas_tarifas', $id_tasas_tarifas);
$sentencia4->bindParam('id_usuario', $usuario);
$sentencia4->bindParam('fyh_creacion', $fechaHora);
$sentencia4->execute();

session_start();
$_SESSION['mensaje'] = "Se registro la tasa/tarifa de la manera correcta";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/tasas_tarifas/');

