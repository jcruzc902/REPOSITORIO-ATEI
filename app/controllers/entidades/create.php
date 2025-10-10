<?php

include ('../../config.php');

$nombre_entidad = mb_strtoupper($_GET['nombre_entidad']);
$ruc_entidad = $_GET['ruc_entidad'];

$contador = 0;
$sql_entidades = "SELECT * FROM tb_entidad_cf where id_entidad_cf!=1 and visible!=1";
$query_entidades = $pdo->prepare($sql_entidades);
$query_entidades->execute();
$entidades_datos = $query_entidades->fetchAll(PDO::FETCH_ASSOC);

foreach ($entidades_datos as $entidades_dato) {
    if ($entidades_dato["ruc"] == $ruc_entidad) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "Este RUC ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/entidades";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_entidad_cf (nombre_entidad,ruc,fyh_creacion) 
    VALUES (:nombre_entidad,:ruc,:fyh_creacion)");

    $sentencia->bindParam('nombre_entidad', $nombre_entidad);
    $sentencia->bindParam('ruc', $ruc_entidad);
    $sentencia->bindParam('fyh_creacion', $fechaHora);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro la entidad de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/entidades";
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





