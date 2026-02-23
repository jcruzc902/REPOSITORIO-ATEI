<?php

include('../../config.php');


$id_carta_fianza = $_POST['id_carta_fianza'];
$periodo = $_POST['periodo'];
$entidad_financiera = $_POST['entidad_financiera'];
$nro_ruc = $_POST['nro_ruc'];
$estado = $_POST['estado'];
$carta_fianza_nro = $_POST['carta_fianza_nro'];
$monto = $_POST['monto'];
$codigo = $_POST['codigo'];
$afianzador = $_POST['afianzador'];
$nro_ruc_2 = $_POST['nro_ruc_2'];
$estado_2 = $_POST['estado_2'];
$objeto_contratacion = $_POST['objeto_contratacion'];
$descripcion_objeto = $_POST['descripcion_objeto'];
$tipo_seleccion = $_POST['tipo_seleccion'];
$numero_seleccion = $_POST['numero_seleccion'];
$anio_convocatoria = $_POST['anio_convocatoria'];
$orden_servicio = $_POST['orden_servicio'];
$orden_compra = $_POST['orden_compra'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_termino = $_POST['fecha_termino'];
$condicion_cf = $_POST['condicion_cf'];
$observacion = $_POST['observacion'];
$documento = $_POST['documento'];
$fecha_documento = $_POST['fecha_documento'];
$receptor = $_POST['receptor'];
$nt = $_POST['nt'];
$anio_nt = $_POST['anio_nt'];
$observacion_nt = $_POST['observacion_nt'];
$tipo_garantia = $_POST['tipo_garantia'];
$id_usuario = $_POST['id_usuario'];

//falta guardar el nuevo archivo en pdf

if ($_FILES["nuevo_archivo"]["name"] == null) {

    $sentencia = $pdo->prepare("UPDATE tb_cartas_fianza 
    SET periodo=:periodo,
    entidad_financiera=:entidad_financiera,
    ruc_entidad=:ruc_entidad,
    estado_entidad=:estado_entidad,
    nro_carta_fianza=:nro_carta_fianza,
    monto=:monto,
    codigo=:codigo,
    afianzador=:afianzador,
    ruc_afianzador=:ruc_afianzador,
    estado_afianzador=:estado_afianzador,
    objeto_contratacion=:objeto_contratacion,
    descripcion_objeto=:descripcion_objeto,
    tipo_seleccion=:tipo_seleccion,
    numero_seleccion=:numero_seleccion,
    anio_convocatoria=:anio_convocatoria,
    orden_servicio=:orden_servicio,
    orden_compra=:orden_compra,
    fecha_inicio=:fecha_inicio,
    fecha_termino=:fecha_termino,
    condicion=:condicion,
    observacion=:observacion,
    documento=:documento,
    fecha_documento=:fecha_documento,
    receptor=:receptor,
    nt_nro=:nt_nro,
    nt_anio=:nt_anio,
    observacion_nt=:observacion_nt,
    tipo_garantia=:tipo_garantia,
    id_usuario=:id_usuario,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_carta_fianza = :id_carta_fianza ");

    $sentencia->bindParam('periodo', $periodo);
    $sentencia->bindParam('entidad_financiera', $entidad_financiera);
    $sentencia->bindParam('ruc_entidad', $nro_ruc);
    $sentencia->bindParam('estado_entidad', $estado);
    $sentencia->bindParam('nro_carta_fianza', $carta_fianza_nro);
    $sentencia->bindParam('monto', $monto);
    $sentencia->bindParam('codigo', $codigo);
    $sentencia->bindParam('afianzador', $afianzador);
    $sentencia->bindParam('ruc_afianzador', $nro_ruc_2);
    $sentencia->bindParam('estado_afianzador', $estado_2);
    $sentencia->bindParam('objeto_contratacion', $objeto_contratacion);
    $sentencia->bindParam('descripcion_objeto', $descripcion_objeto);
    $sentencia->bindParam('tipo_seleccion', $tipo_seleccion);
    $sentencia->bindParam('numero_seleccion', $numero_seleccion);
    $sentencia->bindParam('anio_convocatoria', $anio_convocatoria);
    $sentencia->bindParam('orden_servicio', $orden_servicio);
    $sentencia->bindParam('orden_compra', $orden_compra);
    $sentencia->bindParam('fecha_inicio', $fecha_inicio);
    $sentencia->bindParam('fecha_termino', $fecha_termino);
    $sentencia->bindParam('condicion', $condicion_cf);
    $sentencia->bindParam('observacion', $observacion);
    $sentencia->bindParam('documento', $documento);
    $sentencia->bindParam('fecha_documento', $fecha_documento);
    $sentencia->bindParam('receptor', $receptor);
    $sentencia->bindParam('nt_nro', $nt);
    $sentencia->bindParam('nt_anio', $anio_nt);
    $sentencia->bindParam('observacion_nt', $observacion_nt);
    $sentencia->bindParam('tipo_garantia', $tipo_garantia);
    $sentencia->bindParam('id_usuario', $id_usuario);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_carta_fianza', $id_carta_fianza);
    $sentencia->execute();

} else {
    $visible = 0;

    // Definir la carpeta de destino
    $carpeta_destino = "files/";
    $nombre_archivo = basename($_FILES["nuevo_archivo"]["name"]);
    $nombre_archivo = mb_strtoupper($nombre_archivo); //convierte el nombre de archivo en mayusculas
    $nombre_archivo = str_replace('PDF', 'pdf', $nombre_archivo); //reemplaza PDF por pdf

    $nombre_carta_fianza = str_replace('.pdf', '', $nombre_archivo); //reemplaza .pdf en nulo

    // Mover el archivo a la carpeta de destino
    if (move_uploaded_file($_FILES["nuevo_archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
        //registro de datos con nuevo resolucion
        $sentencia2 = $pdo->prepare('INSERT INTO tb_archivo_cf(nombre_cf,archivo,visible) 
        VALUES (:nombre_cf,:archivo,:visible)');

        $sentencia2->bindParam('nombre_cf', $nombre_carta_fianza);
        $sentencia2->bindParam('archivo', $nombre_archivo);
        $sentencia2->bindParam('visible', $visible);
        $sentencia2->execute();
    }

    $nombre_cf = $nombre_carta_fianza;
    $archivo_cf = $nombre_archivo;

    $sentencia = $pdo->prepare("UPDATE tb_cartas_fianza 
    SET periodo=:periodo,
    entidad_financiera=:entidad_financiera,
    ruc_entidad=:ruc_entidad,
    estado_entidad=:estado_entidad,
    nro_carta_fianza=:nro_carta_fianza,
    monto=:monto,
    codigo=:codigo,
    afianzador=:afianzador,
    ruc_afianzador=:ruc_afianzador,
    estado_afianzador=:estado_afianzador,
    objeto_contratacion=:objeto_contratacion,
    descripcion_objeto=:descripcion_objeto,
    tipo_seleccion=:tipo_seleccion,
    numero_seleccion=:numero_seleccion,
    anio_convocatoria=:anio_convocatoria,
    orden_servicio=:orden_servicio,
    orden_compra=:orden_compra,
    fecha_inicio=:fecha_inicio,
    fecha_termino=:fecha_termino,
    condicion=:condicion,
    observacion=:observacion,
    documento=:documento,
    fecha_documento=:fecha_documento,
    receptor=:receptor,
    nt_nro=:nt_nro,
    nt_anio=:nt_anio,
    observacion_nt=:observacion_nt,
    tipo_garantia=:tipo_garantia,
    nombre_archivo=:nombre_archivo,
    archivo_pdf=:archivo_pdf,
    id_usuario=:id_usuario,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_carta_fianza = :id_carta_fianza ");

    $sentencia->bindParam('periodo', $periodo);
    $sentencia->bindParam('entidad_financiera', $entidad_financiera);
    $sentencia->bindParam('ruc_entidad', $nro_ruc);
    $sentencia->bindParam('estado_entidad', $estado);
    $sentencia->bindParam('nro_carta_fianza', $carta_fianza_nro);
    $sentencia->bindParam('monto', $monto);
    $sentencia->bindParam('codigo', $codigo);
    $sentencia->bindParam('afianzador', $afianzador);
    $sentencia->bindParam('ruc_afianzador', $nro_ruc_2);
    $sentencia->bindParam('estado_afianzador', $estado_2);
    $sentencia->bindParam('objeto_contratacion', $objeto_contratacion);
    $sentencia->bindParam('descripcion_objeto', $descripcion_objeto);
    $sentencia->bindParam('tipo_seleccion', $tipo_seleccion);
    $sentencia->bindParam('numero_seleccion', $numero_seleccion);
    $sentencia->bindParam('anio_convocatoria', $anio_convocatoria);
    $sentencia->bindParam('orden_servicio', $orden_servicio);
    $sentencia->bindParam('orden_compra', $orden_compra);
    $sentencia->bindParam('fecha_inicio', $fecha_inicio);
    $sentencia->bindParam('fecha_termino', $fecha_termino);
    $sentencia->bindParam('condicion', $condicion_cf);
    $sentencia->bindParam('observacion', $observacion);
    $sentencia->bindParam('documento', $documento);
    $sentencia->bindParam('fecha_documento', $fecha_documento);
    $sentencia->bindParam('receptor', $receptor);
    $sentencia->bindParam('nt_nro', $nt);
    $sentencia->bindParam('nt_anio', $anio_nt);
    $sentencia->bindParam('observacion_nt', $observacion_nt);
    $sentencia->bindParam('tipo_garantia', $tipo_garantia);
    $sentencia->bindParam('nombre_archivo', $nombre_cf);
    $sentencia->bindParam('archivo_pdf', $archivo_cf);
    $sentencia->bindParam('id_usuario', $id_usuario);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_carta_fianza', $id_carta_fianza);
    $sentencia->execute();



}

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo los datos de la carta fianza de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/cartas_fianza/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/cartas_fianza/update.php?id=' . $id_devolucion_dinero);
}











