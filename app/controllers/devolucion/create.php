<?php
/**
 
 * Date: 29/1/2023
 * Time: 22:50
 */


include ('../../config.php');

if ($_POST['id_dependencia'] == "") {
    $_POST['id_dependencia'] = "1";
}





$id_anio_periodo = $_POST['id_anio_periodo'];
$nt = mb_strtoupper($_POST['nt']);
$id_anio_nt = $_POST['id_anio_nt'];
$proveido = mb_strtoupper($_POST['proveido']);
$fecha_proveido = $_POST['fecha_proveido'];
$oficio = mb_strtoupper($_POST['oficio']);
$fecha_oficio = $_POST['fecha_oficio'];
$informe = mb_strtoupper($_POST['informe']);
$fecha_informe = $_POST['fecha_informe'];
$observacion= $_POST['observacion'];
$id_dependencia = $_POST['id_dependencia'];
$id_estado = $_POST['id_estado'];
$id_usuario = $_POST['id_usuario'];

$contador = 0;
$sql_devolucion = "SELECT * FROM tb_devoluciones where visible!=1";
$query_devolucion = $pdo->prepare($sql_devolucion);
$query_devolucion->execute();
$devolucion_datos = $query_devolucion->fetchAll(PDO::FETCH_ASSOC);

foreach ($devolucion_datos as $devolucion_dato) {
    if (($devolucion_dato["nt"] == $nt) && ($devolucion_dato["id_anio_nt"] == $_POST['id_anio_nt'])) {
        $numero_tramite = $_POST['nt'];
        $anio_nt = $_POST['id_anio_nt'];
        $contador = 1;
    }
}

$sql_anio_nt = "SELECT * FROM tb_anio_nt WHERE id_anio_nt='$anio_nt'";
$query_anio_nt = $pdo->prepare($sql_anio_nt);
$query_anio_nt->execute();
$devolucion_anio_nt = $query_anio_nt->fetchAll(PDO::FETCH_ASSOC);

foreach ($devolucion_anio_nt as $anios_nt) {
    $anio = $anios_nt['anio_nt'];
}




if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El NT " . $numero_tramite . " del año " . $anio . " ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/devoluciones/create.php";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare('INSERT INTO tb_devoluciones(nt,proveido,fecha_proveido,oficio,fecha_oficio,informe,fecha_informe,observacion_devolucion,
    id_dependencia,id_estado_devolucion,id_usuario,id_anio_nt,id_anio_periodo,fyh_creacion) 
    VALUES (:nt,:proveido,:fecha_proveido,:oficio,:fecha_oficio,:informe,:fecha_informe,:observacion_devolucion,:id_dependencia,:id_estado_devolucion,:id_usuario,:id_anio_nt,
    :id_anio_periodo,:fyh_creacion)');

    $sentencia->bindParam('nt', $nt);
    $sentencia->bindParam('proveido', $proveido);
    $sentencia->bindParam('fecha_proveido', $fecha_proveido);
    $sentencia->bindParam('oficio', $oficio);
    $sentencia->bindParam('fecha_oficio', $fecha_oficio);
    $sentencia->bindParam('informe', $informe);
    $sentencia->bindParam('fecha_informe', $fecha_informe);
    $sentencia->bindParam('observacion_devolucion', $observacion);

    $sentencia->bindParam('id_dependencia', $id_dependencia);
    $sentencia->bindParam('id_estado_devolucion', $id_estado);
    $sentencia->bindParam('id_usuario', $id_usuario);
    
    $sentencia->bindParam('id_anio_nt', $id_anio_nt);
    $sentencia->bindParam('id_anio_periodo', $id_anio_periodo);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->execute();

    

    session_start();
    $_SESSION['mensaje'] = "Se registro la devolucion de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/devoluciones/');

}