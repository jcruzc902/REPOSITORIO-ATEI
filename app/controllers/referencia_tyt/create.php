<?php

include ('../../config.php');

$nombre_referencia = mb_strtoupper($_GET['nombre_referencia']);

$contador = 0;
$sql_referencia = "SELECT * FROM tb_referencias_tyt where visible!=1 and id_referencia_tyt!=1";
$query_referencia = $pdo->prepare($sql_referencia);
$query_referencia->execute();
$referencia_datos = $query_referencia->fetchAll(PDO::FETCH_ASSOC);

foreach ($referencia_datos as $referencia_dato) {
    if ($referencia_dato["nombre_referencia"] == $nombre_referencia) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de referencia ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/referencia_tyt";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_referencias_tyt (nombre_referencia) 
    VALUES (:nombre_referencia)");

    $sentencia->bindParam('nombre_referencia', $nombre_referencia);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro la referencia de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/referencia_tyt";
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
