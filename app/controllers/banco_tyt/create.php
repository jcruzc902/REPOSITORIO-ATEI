<?php

include ('../../config.php');

$nombre_banco = mb_strtoupper($_GET['nombre_banco']);

$contador = 0;
$sql_banco = "SELECT * FROM tb_banco_tyt where visible!=1 and id_banco_tyt!=1";
$query_banco = $pdo->prepare($sql_banco);
$query_banco->execute();
$banco_datos = $query_banco->fetchAll(PDO::FETCH_ASSOC);

foreach ($banco_datos as $banco_dato) {
    if ($banco_dato["nombre_banco"] == $nombre_banco) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de banco ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/banco_sb";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_banco_tyt (nombre_banco) 
    VALUES (:nombre_banco)");

    $sentencia->bindParam('nombre_banco', $nombre_banco);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el banco de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/banco_sb";
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
