<?php

include ('../../config.php');

$nombre_banco = mb_strtoupper($_GET['nombre_banco']);

$contador = 0;
$sql_bancos = "SELECT * FROM tb_bancos where visible!=1 and id_banco!=1";
$query_bancos = $pdo->prepare($sql_bancos);
$query_bancos->execute();
$bancos_datos = $query_bancos->fetchAll(PDO::FETCH_ASSOC);

foreach ($bancos_datos as $bancos_dato) {
    if ($bancos_dato["nombre_banco"] == $nombre_banco) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre del banco ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/bancos";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_bancos (nombre_banco,fyh_creacion) 
    VALUES (:nombre_banco,:fyh_creacion)");

    $sentencia->bindParam('nombre_banco', $nombre_banco);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el nombre del banco de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/bancos";
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






