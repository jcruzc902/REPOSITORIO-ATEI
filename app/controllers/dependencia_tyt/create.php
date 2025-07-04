<?php

include ('../../config.php');

$nombre_dependencia = mb_strtoupper($_GET['nombre_dependencia']);
$codigo_facultad = mb_strtoupper($_GET['codigo_facultad']);

$contador = 0;
$sql_dependencia = "SELECT * FROM tb_dependencias_tyt where visible!=1 and id_dependencias_tyt!=1";
$query_dependencia = $pdo->prepare($sql_dependencia);
$query_dependencia->execute();
$dependencia_datos = $query_dependencia->fetchAll(PDO::FETCH_ASSOC);

foreach ($dependencia_datos as $dependencia_dato) {
    if ($dependencia_dato["nombre_dependencias_tyt"] == $nombre_dependencia) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de dependencia ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/dependencia_tyt";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_dependencias_tyt (nombre_dependencias_tyt,codigo_facultad) 
    VALUES (:nombre_dependencias_tyt,:codigo_facultad)");

    $sentencia->bindParam('nombre_dependencias_tyt', $nombre_dependencia);
    $sentencia->bindParam('codigo_facultad', $codigo_facultad);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro la dependencia de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/dependencia_tyt";
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
