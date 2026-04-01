<?php

include ('../../config.php');

$nombre_especialidad = mb_strtoupper($_GET['nombre_especialidad']);

$contador = 0;
$sql_especialidades = "SELECT * FROM tb_especialidades";
$query_especialidades = $pdo->prepare($sql_especialidades);
$query_especialidades->execute();
$especialidades_datos = $query_especialidades->fetchAll(PDO::FETCH_ASSOC);

foreach ($especialidades_datos as $especialidades_dato) {
    if ($especialidades_dato["nombre_especialidad"] == $nombre_especialidad) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de esta especialidad ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/detalle_estado_egresos/create.php";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_especialidades (nombre_especialidad) 
    VALUES (:nombre_especialidad)");

    $sentencia->bindParam('nombre_especialidad', $nombre_especialidad);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro la especialidad de la manera correcta";
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
