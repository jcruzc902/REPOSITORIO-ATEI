<?php

include ('../../config.php');

$nombre_detalle_pago = mb_strtoupper($_GET['nombre_detalle_pago']);
$id_detalle_egreso= $_GET['id_detalle_egreso'];

$contador = 0;
$sql_detalles = "SELECT * FROM tb_detalles";
$query_detalles = $pdo->prepare($sql_detalles);
$query_detalles->execute();
$detalles_datos = $query_detalles->fetchAll(PDO::FETCH_ASSOC);

foreach ($detalles_datos as $detalles_dato) {
    if ($detalles_dato["nombre_detalles"] == $nombre_detalle_pago) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de este detalle ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/detalle_estado_egresos/update.php?id=<?php echo $id_detalle_egreso; ?>";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_detalles (nombre_detalles) 
    VALUES (:nombre_detalles)");

    $sentencia->bindParam('nombre_detalles', $nombre_detalle_pago);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el detalle de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/detalle_estado_egresos/update.php?id=<?php echo $id_detalle_egreso; ?>";
        </script>
        <?php
    } else {
        #echo "Error las contraseñas no son iguales";
        session_start();
        $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
        $_SESSION['icono'] = "error";
        #header('Location: ' . $URL . '/categorias');

    }
}
