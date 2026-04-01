<?php

include ('../../config.php');

$nombre_modalidad = mb_strtoupper($_GET['nombre_modalidad']);

$contador = 0;
$sql_modalidad = "SELECT * FROM tb_modalidad_tyt where visible!=1 and id_modalidad_tyt!=1";
$query_modalidad = $pdo->prepare($sql_modalidad);
$query_modalidad->execute();
$modalidad_datos = $query_modalidad->fetchAll(PDO::FETCH_ASSOC);

foreach ($modalidad_datos as $modalidad_dato) {
    if ($modalidad_dato["nombre_modalidad"] == $nombre_modalidad) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de modalidad ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/modalidad_tyt";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_modalidad_tyt (nombre_modalidad) 
    VALUES (:nombre_modalidad)");

    $sentencia->bindParam('nombre_modalidad', $nombre_modalidad);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro la modalidad de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/modalidad_tyt";
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
