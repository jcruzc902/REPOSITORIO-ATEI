<?php

include ('../../config.php');

$nombre_dependencia = $_GET['nombre_dependencia'];

$contador = 0;
$sql_dependencia = "SELECT * FROM tb_dependencia_ingresos where visible!=1";
$query_dependencia = $pdo->prepare($sql_dependencia);
$query_dependencia->execute();
$dependencia_datos = $query_dependencia->fetchAll(PDO::FETCH_ASSOC);

foreach ($dependencia_datos as $dependencia_dato) {
    if ($dependencia_dato["nombre_dependencia"] == $nombre_dependencia) {
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
        location.href = "<?php echo $URL; ?>/dependencia_ingresos";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_dependencia_ingresos (nombre_dependencia) 
    VALUES (:nombre_dependencia)");

    $sentencia->bindParam('nombre_dependencia', $nombre_dependencia);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el nombre de dependencia de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/dependencia_ingresos";
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
