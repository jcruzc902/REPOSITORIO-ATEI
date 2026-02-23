<?php

include ('../../config.php');

$clasificador = mb_strtoupper($_GET['clasificador']);
$descripcion_clasificador = mb_strtoupper($_GET['descripcion_clasificador']);

$contador = 0;
$sql_clasificador = "SELECT * FROM tb_clasificador_cb where visible!=1";
$query_clasificador = $pdo->prepare($sql_clasificador);
$query_clasificador->execute();
$clasificador_datos = $query_clasificador->fetchAll(PDO::FETCH_ASSOC);

foreach ($clasificador_datos as $clasificador_dato) {
    if ($clasificador_dato["clasificador_cb"] == $clasificador && $clasificador_dato["descripcion_cb"] == $descripcion_clasificador) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El numero de clasificador ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/clasificador_cb";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_clasificador_cb (clasificador_cb,descripcion_cb, fyh_creacion) 
    VALUES (:clasificador_cb,:descripcion_cb,:fyh_creacion)");

    $sentencia->bindParam('clasificador_cb', $clasificador);
    $sentencia->bindParam('descripcion_cb', $descripcion_clasificador);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el clasificador de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/clasificador_cb";
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






