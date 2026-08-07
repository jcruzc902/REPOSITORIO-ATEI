<?php

include ('../../config.php');

$nombre_asunto = mb_strtoupper($_GET['nombre_asunto']);

$contador = 0;
$sql_asunto = "SELECT * FROM tb_asunto where visible!=1 and id_asunto!=1";
$query_asunto = $pdo->prepare($sql_asunto);
$query_asunto->execute();
$asunto_datos = $query_asunto->fetchAll(PDO::FETCH_ASSOC);

foreach ($asunto_datos as $asunto_dato) {
    if ($asunto_dato["nombre_asunto"] == $nombre_asunto) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de asunto ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/cheques/create.php";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_asunto (nombre_asunto) 
    VALUES (:nombre_asunto)");

    $sentencia->bindParam('nombre_asunto', $nombre_asunto);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el asunto de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/cheques/create.php";
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
