<?php

include ('../../config.php');

$nombre_dependencia = mb_strtoupper($_GET['nombre_dependencia']);

$contador = 0;
$sql_dependencias = "SELECT * FROM tb_dependencias where visible!=1 and id_dependencia!=1";
$query_dependencias = $pdo->prepare($sql_dependencias);
$query_dependencias->execute();
$dependencias_datos = $query_dependencias->fetchAll(PDO::FETCH_ASSOC);

foreach ($dependencias_datos as $dependencias_dato) {
    if ($dependencias_dato["nombre"] == $nombre_dependencia) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de la dependencia ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/dependencias";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_dependencias (nombre,fyh_creacion) 
    VALUES (:nombre,:fyh_creacion)");

    $sentencia->bindParam('nombre', $nombre_dependencia);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro la facultad o dependencia de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/dependencias";
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






