<?php

include ('../../config.php');

$nombre_subactividad = mb_strtoupper($_GET['nombre_subactividad']);
$id_actividad = $_GET['id_actividad'];
$id_cargo = $_GET['id_cargo'];

$contador = 0;

$sql_subactividad= "SELECT * FROM tb_subactividad WHERE visible!=1";
$query_subactividad = $pdo->prepare($sql_subactividad);
$query_subactividad->execute();
$subactividad_datos = $query_subactividad->fetchAll(PDO::FETCH_ASSOC);

foreach ($subactividad_datos as $subactividad_dato) {
    if ($subactividad_dato["nombre_subactividad"] == $nombre_subactividad && $subactividad_dato["id_actividad_principal"] == $id_actividad) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de la subactividad ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/subactividad";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_subactividad (nombre_subactividad,id_actividad_principal,id_cargo,fyh_creacion) 
    VALUES (:nombre_subactividad,:id_actividad_principal,:id_cargo,:fyh_creacion)");

    $sentencia->bindParam('nombre_subactividad', $nombre_subactividad);
    $sentencia->bindParam('id_actividad_principal', $id_actividad);
    $sentencia->bindParam('id_cargo', $id_cargo);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro la subactividad de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/subactividad";
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






