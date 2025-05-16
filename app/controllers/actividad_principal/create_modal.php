<?php

include('../../config.php');

$nombre_actividad = mb_strtoupper($_GET['nombre_actividad']);
$id_cargo = $_GET['id_cargo'];

$contador = 0;
$sql_actividad_principal = "SELECT actividad.id_actividad_principal as id_actividad_principal,
actividad.nombre_actividad as nombre_actividad,
cargo.id_cargo as id_cargo,
cargo.nombre_cargo as nombre_cargo 
FROM tb_actividad_principal as actividad
INNER JOIN tb_cargo as cargo ON cargo.id_cargo = actividad.id_cargo 
WHERE actividad.id_actividad_principal!=1 AND actividad.visible!=1 ORDER BY actividad.nombre_actividad ASC";
$query_actividad_principal = $pdo->prepare($sql_actividad_principal);
$query_actividad_principal->execute();
$actividad_principal_datos = $query_actividad_principal->fetchAll(PDO::FETCH_ASSOC);

foreach ($actividad_principal_datos as $actividad_principal_dato) {
    if ($actividad_principal_dato["nombre_actividad"] == $nombre_actividad && $actividad_principal_dato["id_cargo"] == $id_cargo) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de la actividad principal ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/estado_egresos/create.php";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_actividad_principal (nombre_actividad,id_cargo,fyh_creacion) 
    VALUES (:nombre_actividad,:id_cargo,:fyh_creacion)");

    $sentencia->bindParam('nombre_actividad', $nombre_actividad);
    $sentencia->bindParam('id_cargo', $id_cargo);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro la actividad principal de la manera correcta";
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






