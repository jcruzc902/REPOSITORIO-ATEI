<?php

include ('../../config.php');

$dependencia = $_POST['dependencia'];
$detalle_concepto = mb_strtoupper($_POST['detalle_concepto']);
$banco = $_POST['banco'];
$fecha_recaudacion = $_POST['fecha_recaudacion'];
$nombre_encargado = mb_strtoupper($_POST['nombre_encargado']);
$documento_recepcion = mb_strtoupper($_POST['documento_recepcion']);
$monto_recaudado = $_POST['monto_recaudado'];
$monto_recaudado= str_replace(",","",$monto_recaudado); //reemplazo la coma por vacio
$monto_recaudado= str_replace("'","",$monto_recaudado); //reemplaza el millar por vacio
$banco_deposito = $_POST['banco_deposito'];
$cuenta_deposito = $_POST['cuenta_deposito'];
$fecha_deposito = $_POST['fecha_deposito'];
$nro_documento = $_POST['nro_documento'];
$importe = $_POST['importe'];
$importe= str_replace(",","",$importe); //reemplazo la coma por vacio
$importe= str_replace("'","",$importe); //reemplaza el millar por vacio
$nombre_depositante = mb_strtoupper($_POST['nombre_depositante']);
$numero_dni = $_POST['numero_dni'];
$numero_operacion = $_POST['numero_operacion'];
$estado = $_POST['estado'];
$id_usuario = $_POST['id_usuario'];
$visible = 0;

$contador = 0;
$sql_recaudacion_ingreso = "SELECT * FROM tb_recaudacion_ingresos where visible!=1";
$query_recaudacion_ingreso = $pdo->prepare($sql_recaudacion_ingreso);
$query_recaudacion_ingreso->execute();
$recaudacion_ingreso_datos = $query_recaudacion_ingreso->fetchAll(PDO::FETCH_ASSOC);

//verifica duplicado en la base de datos
foreach ($recaudacion_ingreso_datos as $recaudacion_ingreso_dato) {
    if (
        ($recaudacion_ingreso_dato["detalle_concepto"] == $_POST['detalle_concepto']) 
        && ($recaudacion_ingreso_dato["fecha_recaudacion"] == $_POST['fecha_recaudacion']) 
        && ($recaudacion_ingreso_dato["numero_documento"] == $_POST['nro_documento']) 
        && ($recaudacion_ingreso_dato["importe"] == $_POST['importe']) 
        && ($recaudacion_ingreso_dato["numero_operacion"] == $_POST['numero_operacion'])
    ) {
        $contador = 1;
    }
}


if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "La recaudacion de ingreso ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/recaudacion_ingresos/create.php";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare('INSERT INTO tb_recaudacion_ingresos(nombre_dependencia,detalle_concepto,nombre_banco,fecha_recaudacion,
    nombre_encargado,documento_recepcion,monto_recaudado,nombre_banco2,numero_cuenta2,fecha_deposito,numero_documento,importe,nombre_depositante,dni,
    numero_operacion,estado,visible,id_usuario,fyh_creacion) VALUES (:nombre_dependencia,:detalle_concepto,:nombre_banco,:fecha_recaudacion,:nombre_encargado,:documento_recepcion,:monto_recaudado,
    :nombre_banco2,:numero_cuenta2,:fecha_deposito,:numero_documento,:importe,:nombre_depositante,:dni,:numero_operacion,:estado,:visible,:id_usuario,:fyh_creacion)');

    $sentencia->bindParam('nombre_dependencia', $dependencia);
    $sentencia->bindParam('detalle_concepto', $detalle_concepto);
    $sentencia->bindParam('nombre_banco', $banco);
    $sentencia->bindParam('fecha_recaudacion', $fecha_recaudacion);
    $sentencia->bindParam('nombre_encargado', $nombre_encargado);
    $sentencia->bindParam('documento_recepcion', $documento_recepcion);
    $sentencia->bindParam('monto_recaudado', $monto_recaudado);
    $sentencia->bindParam('nombre_banco2', $banco_deposito);
    $sentencia->bindParam('numero_cuenta2', $cuenta_deposito);
    $sentencia->bindParam('fecha_deposito', $fecha_deposito);
    $sentencia->bindParam('numero_documento', $nro_documento);
    $sentencia->bindParam('importe', $importe);
    $sentencia->bindParam('nombre_depositante', $nombre_depositante);
    $sentencia->bindParam('dni', $numero_dni);
    $sentencia->bindParam('numero_operacion', $numero_operacion);
    $sentencia->bindParam('estado', $estado);
    $sentencia->bindParam('visible', $visible);
    $sentencia->bindParam('id_usuario', $id_usuario);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->execute();


    session_start();
    $_SESSION['mensaje'] = "Se registro la recaudacion de ingreso de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/recaudacion_ingresos/');

}