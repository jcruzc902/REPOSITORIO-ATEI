<?php

include ('../../config.php');

$nombre_cuenta = mb_strtoupper($_GET['nombre_cuenta']);
$id_banco_cuenta = $_GET['id_banco_cuenta'];

$contador = 0;
$sql_nombre_cuenta = "SELECT * FROM tb_nombre_cuenta";
$query_nombre_cuenta = $pdo->prepare($sql_nombre_cuenta);
$query_nombre_cuenta->execute();
$nombre_datos = $query_nombre_cuenta->fetchAll(PDO::FETCH_ASSOC);

foreach ($nombre_datos as $nombre_dato) {
    if ($nombre_dato["nombre_cuenta"] == $nombre_cuenta && $nombre_dato["id_numero_cuenta"] == $id_banco_cuenta) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de la cuenta ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/nombre_sb";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_nombre_cuenta (nombre_cuenta,id_numero_cuenta,fyh_creacion) 
    VALUES (:nombre_cuenta,:id_numero_cuenta,:fyh_creacion)");

    $sentencia->bindParam('nombre_cuenta', $nombre_cuenta);
    $sentencia->bindParam('id_numero_cuenta', $id_banco_cuenta);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el nombre de la cuenta de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/nombre_sb";
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






