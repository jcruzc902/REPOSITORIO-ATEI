<?php

include ('../../config.php');

$nombre_subactividad = mb_strtoupper($_GET['nombre_subactividad']);
$id_actividad = $_GET['id_actividad'];

$contador = 0;
$sql_subactividad = "SELECT subactividad.id_subactividad as id_subactividad,
subactividad.nombre_subactividad as nombre_subactividad,
actividad_principal.id_actividad_principal as id_actividad_principal,
actividad_principal.nombre_actividad as nombre_actividad_principal 
FROM tb_subactividad as subactividad 
INNER JOIN tb_actividad_principal as actividad_principal ON actividad_principal.id_actividad_principal = subactividad.id_actividad_principal 
WHERE subactividad.id_subactividad!=1 AND subactividad.visible!=1 ORDER BY subactividad.nombre_subactividad ASC";
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
        location.href = "<?php echo $URL; ?>/estado_egresos/create.php";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_subactividad (nombre_subactividad,id_actividad_principal,fyh_creacion) 
    VALUES (:nombre_subactividad,:id_actividad_principal,:fyh_creacion)");

    $sentencia->bindParam('nombre_subactividad', $nombre_subactividad);
    $sentencia->bindParam('id_actividad_principal', $id_actividad);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro la subactividad de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/estado_egresos/create.php";
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






