<?php

include ('../../config.php');

$nombre_dependencia = mb_strtoupper($_GET['nombre_dependencia']);

$contador = 0;
$sql_facultad = "SELECT * FROM tb_facultades_cb where visible!=1";
$query_facultad = $pdo->prepare($sql_facultad);
$query_facultad->execute();
$facultad_datos = $query_facultad->fetchAll(PDO::FETCH_ASSOC);

foreach ($facultad_datos as $facultad_dato) {
    if ($facultad_dato["nombre_facultad"] == $nombre_dependencia) {
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
        location.href = "<?php echo $URL; ?>/facultad_cb";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_facultades_cb (nombre_facultad,fyh_creacion) 
    VALUES (:nombre_facultad,:fyh_creacion)");

    $sentencia->bindParam('nombre_facultad', $nombre_dependencia);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro la dependencia de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/facultad_cb";
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






