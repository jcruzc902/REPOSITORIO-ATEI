<?php

include ('../../config.php');

$nombre_concepto = mb_strtoupper($_GET['nombre_concepto']);

$contador = 0;
$sql_concepto = "SELECT * FROM tb_concepto_tyt where visible!=1 and id_concepto_tyt!=1";
$query_concepto = $pdo->prepare($sql_concepto);
$query_concepto->execute();
$concepto_datos = $query_concepto->fetchAll(PDO::FETCH_ASSOC);

foreach ($concepto_datos as $concepto_dato) {
    if ($concepto_dato["nombre_concepto_tyt"] == $nombre_concepto) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de concepto ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/concepto_tyt";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_concepto_tyt (nombre_concepto_tyt) 
    VALUES (:nombre_concepto_tyt)");

    $sentencia->bindParam('nombre_concepto_tyt', $nombre_concepto);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el concepto de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/concepto_tyt";
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
