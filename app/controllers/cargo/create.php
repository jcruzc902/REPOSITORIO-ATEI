<?php

include ('../../config.php');

$nombre_cargo = mb_strtoupper($_GET['nombre_cargo']);

$contador = 0;
$sql_cargo = "SELECT * FROM tb_cargo where visible!=1 and id_cargo!=1";
$query_cargo = $pdo->prepare($sql_cargo);
$query_cargo->execute();
$cargo_datos = $query_cargo->fetchAll(PDO::FETCH_ASSOC);

foreach ($cargo_datos as $cargo_dato) {
    if ($cargo_dato["nombre_cargo"] == $nombre_cargo) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre del cargo ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/cargo";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_cargo (nombre_cargo,fyh_creacion) 
    VALUES (:nombre_cargo,:fyh_creacion)");

    $sentencia->bindParam('nombre_cargo', $nombre_cargo);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el cargo de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/cargo";
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






