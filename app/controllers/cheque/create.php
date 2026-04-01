<?php
/**
 
 * Date: 29/1/2023
 * Time: 22:50
 */


include ('../../config.php');




$nt = $_POST['nt'];
$id_anio_nt = $_POST['id_anio_nt'];
$proveido_diga = $_POST['proveido_diga'];
$fecha_proveido_diga = $_POST['fecha_proveido_diga'];
$proveido_conta = $_POST['proveido_conta'];
$fecha_proveido_conta = $_POST['fecha_proveido_conta'];
$informe= mb_strtoupper($_POST['informe']);
$fecha_informe= $_POST['fecha_informe'];
$id_asunto = $_POST['id_asunto'];
$id_tipo_gasto = $_POST['id_tipo_gasto'];
$oficio = mb_strtoupper($_POST['oficio']);
$fecha_oficio = $_POST['fecha_oficio'];
$id_usuario = $_POST['id_usuario'];

$contador = 0;
$sql_cheque = "SELECT * FROM tb_cheque where visible!=1";
$query_cheque = $pdo->prepare($sql_cheque);
$query_cheque->execute();
$cheque_datos = $query_cheque->fetchAll(PDO::FETCH_ASSOC);

//VERIFICA REGISTROS DUPLICADOS POR NT Y AÑO
foreach ($cheque_datos as $cheque_dato) {
    if (($cheque_dato["nt"] == $_POST['nt']) && ($cheque_dato["id_anio_nt"] == $_POST['id_anio_nt']) && ($cheque_dato["proveido_diga"] == $_POST['proveido_diga']) && ($cheque_dato["proveido_conta"] == $_POST['proveido_conta']) && ($cheque_dato["oficio"] == $_POST['oficio'])) {
        $numero_tramite = $_POST['nt'];
        $anio_nt = $_POST['id_anio_nt'];
        $contador = 1;
    }
}

$sql_anio_nt = "SELECT * FROM tb_anio_nt WHERE id_anio_nt='$id_anio_nt'";
$query_anio_nt = $pdo->prepare($sql_anio_nt);
$query_anio_nt->execute();
$cheque_anio_nt = $query_anio_nt->fetchAll(PDO::FETCH_ASSOC);

foreach ($cheque_anio_nt as $anios_nt) {
    $anio = $anios_nt['anio_nt'];
}




if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El NT " . $numero_tramite . " del año " . $anio . " ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/cheques/create.php";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare('INSERT INTO tb_cheque(nt,id_anio_nt,proveido_diga,fecha_diga,proveido_conta,fecha_conta,informe,fecha_informe,id_asunto,
    id_tipo_gasto,oficio,fecha_oficio,id_usuario,fyh_creacion) 
    VALUES (:nt,:id_anio_nt,:proveido_diga,:fecha_diga,:proveido_conta,:fecha_conta,:informe,:fecha_informe,:id_asunto,
    :id_tipo_gasto,:oficio,:fecha_oficio,:id_usuario,:fyh_creacion)');

    $sentencia->bindParam('nt', $nt);
    $sentencia->bindParam('id_anio_nt', $id_anio_nt);
    $sentencia->bindParam('proveido_diga', $proveido_diga);
    $sentencia->bindParam('fecha_diga', $fecha_proveido_diga);
    $sentencia->bindParam('proveido_conta', $proveido_conta);
    $sentencia->bindParam('fecha_conta', $fecha_proveido_conta);
    $sentencia->bindParam('informe', $informe);
    $sentencia->bindParam('fecha_informe', $fecha_informe);
    $sentencia->bindParam('id_asunto', $id_asunto);
    $sentencia->bindParam('id_tipo_gasto', $id_tipo_gasto);
    $sentencia->bindParam('oficio', $oficio);
    $sentencia->bindParam('fecha_oficio', $fecha_oficio);
    $sentencia->bindParam('id_usuario', $id_usuario);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->execute();

    

    session_start();
    $_SESSION['mensaje'] = "Se registro el cheque de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/cheques/');

}