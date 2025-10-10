<?php
/**
 
 * Date: 29/1/2023
 * Time: 22:50
 */


include ('../../config.php');


$banco = $_POST['banco'];
$cuenta = $_POST['cuenta'];
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$situacion = $_POST['situacion'];
$detalle_cuenta = mb_strtoupper($_POST['detalle_cuenta']);
$fecha = $_POST['fecha'];
$monto = floatval($_POST['monto']);
$monto = number_format($monto, 2, '.', ''); //convertir int a decimal
$id_estado_saldo = $_POST['id_estado_saldo'];
$id_usuario = $_POST['id_usuario'];
$visible = 0;

$contador = 0;
$sql_saldo_bancario = "SELECT * FROM tb_saldo_banco where visible!=1 AND fecha='$fecha'";
$query_saldo_bancario = $pdo->prepare($sql_saldo_bancario);
$query_saldo_bancario->execute();
$saldo_bancario_datos = $query_saldo_bancario->fetchAll(PDO::FETCH_ASSOC);

//verifica duplicado de numero de cuenta en la misma fecha del saldo bancario
foreach ($saldo_bancario_datos as $saldo_bancario_dato) {
    if (
        ($saldo_bancario_dato["nombre_banco"] == $_POST['banco']) && ($saldo_bancario_dato["numero_cuenta"] == $_POST['cuenta'])
        && ($saldo_bancario_dato["nombre_cuenta"] == $_POST['nombre']) && ($saldo_bancario_dato["tipo_cuenta"] == $_POST['tipo'])
        && ($saldo_bancario_dato["situacion"] == $_POST['situacion']) && ($saldo_bancario_dato["fecha"] == $_POST['fecha'])
    ) {
        $contador = 1;
    }

    /*
    if(($saldo_bancario_dato["numero_cuenta"] == $_POST['cuenta'])){
        $contador = 1;
    }*/
}




if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El saldo bancario ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/saldos/create.php";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare('INSERT INTO tb_saldo_banco(nombre_banco,numero_cuenta,nombre_cuenta,tipo_cuenta,situacion,detalle_cuenta,fecha,monto,
estado,visible,id_usuario,fyh_creacion) VALUES (:nombre_banco,:numero_cuenta,:nombre_cuenta,:tipo_cuenta,:situacion,:detalle_cuenta,
:fecha,:monto,:estado,:visible,:id_usuario,:fyh_creacion)');

    $sentencia->bindParam('nombre_banco', $banco);
    $sentencia->bindParam('numero_cuenta', $cuenta);
    $sentencia->bindParam('nombre_cuenta', $nombre);
    $sentencia->bindParam('tipo_cuenta', $tipo);
    $sentencia->bindParam('situacion', $situacion);
    $sentencia->bindParam('detalle_cuenta', $detalle_cuenta);
    $sentencia->bindParam('fecha', $fecha);
    $sentencia->bindParam('monto', $monto);
    $sentencia->bindParam('estado', $id_estado_saldo);
    $sentencia->bindParam('visible', $visible);
    $sentencia->bindParam('id_usuario', $id_usuario);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->execute();



    session_start();
    $_SESSION['mensaje'] = "Se registro el saldo bancario de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/saldos/');

}