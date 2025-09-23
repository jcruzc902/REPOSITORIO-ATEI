<?php
/**

 * Date: 29/1/2023
 * Time: 22:50
 */


include('../../config.php');

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

$contador = 0;
$sql_carta_fianza = "SELECT * FROM tb_cartas_fianza where visible!=1";
$query_carta_fianza = $pdo->prepare($sql_carta_fianza);
$query_carta_fianza->execute();
$carta_fianza_datos = $query_carta_fianza->fetchAll(PDO::FETCH_ASSOC);

foreach ($carta_fianza_datos as $carta_fianza_dato) {
    if (($carta_fianza_dato["nro_carta_fianza"] == $carta_fianza_nro) && ($carta_fianza_dato["nt_nro"] == $nt)) {
        $nro_carta_fianza = $_POST['carta_fianza_nro'];
        $contador = 1;
    }
}


if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El numero de carta fianza " . $nro_carta_fianza . " ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/cartas_fianza/create.php";
    </script>
    <?php
} else {

    $visible= 0;

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

    $sentencia = $pdo->prepare('INSERT INTO tb_cartas_fianza(entidad_financiera,ruc_entidad,estado_entidad,nro_carta_fianza,monto,codigo,
    afianzador,ruc_afianzador,estado_afianzador,objeto_contratacion,descripcion_objeto,tipo_seleccion,numero_seleccion,anio_convocatoria,
    orden_servicio,orden_compra,fecha_inicio,fecha_termino,condicion,observacion,documento,fecha_documento,receptor,nt_nro,nt_anio,observacion_nt,
    tipo_garantia,nombre_archivo,archivo_pdf,id_usuario,fyh_creacion) 
    VALUES (:entidad_financiera,:ruc_entidad,:estado_entidad,:nro_carta_fianza,:monto,:codigo,:afianzador,:ruc_afianzador,:estado_afianzador,:objeto_contratacion,
    :descripcion_objeto,:tipo_seleccion,:numero_seleccion,:anio_convocatoria,:orden_servicio,:orden_compra,:fecha_inicio,:fecha_termino,:condicion,:observacion,
    :documento,:fecha_documento,:receptor,:nt_nro,:nt_anio,:observacion_nt,:tipo_garantia,:nombre_archivo,:archivo_pdf,:id_usuario,:fyh_creacion)');

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
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->execute();


    session_start();
    $_SESSION['mensaje'] = "Se registro la carta fianza de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/cartas_fianza/');

}