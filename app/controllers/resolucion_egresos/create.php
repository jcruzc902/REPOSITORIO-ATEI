<?php

include ('../../config.php');

$numero_resolucion = mb_strtoupper($_GET['numero_resolucion']);
$fecha_resolucion = mb_strtoupper($_GET['fecha']);

$contador = 0;
$sql_resolucion = "SELECT * FROM tb_resoluciones_egresos where visible!=1";
$query_resolucion = $pdo->prepare($sql_resolucion);
$query_resolucion->execute();
$resolucion_datos = $query_resolucion->fetchAll(PDO::FETCH_ASSOC);

foreach ($resolucion_datos as $resolucion_dato) {
    if ($resolucion_dato["resolucion"] == $numero_resolucion) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El numero de esta resolucion ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/detalle_estado_egresos/create.php";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_resoluciones_egresos (resolucion,fecha) 
    VALUES (:resolucion,:fecha)");

    $sentencia->bindParam('resolucion', $numero_resolucion);
    $sentencia->bindParam('fecha', $fecha_resolucion);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro la resolucion de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/detalle_estado_egresos/create.php";
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
