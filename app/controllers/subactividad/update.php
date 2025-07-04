<?php

include('../../config.php');

$nombre_subactividad = mb_strtoupper($_GET['nombre_subactividad']);
$id_actividad = $_GET['id_actividad'];
$id_subactividad = $_GET['id_subactividad'];

$sentencia = $pdo->prepare("UPDATE tb_subactividad
SET nombre_subactividad=:nombre_subactividad,
id_actividad_principal=:id_actividad_principal,
fyh_actualizacion=:fyh_actualizacion
WHERE id_subactividad=:id_subactividad");

$sentencia->bindParam('nombre_subactividad', $nombre_subactividad);
$sentencia->bindParam('id_actividad_principal', $id_actividad);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_subactividad', $id_subactividad);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo la subactividad de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/subactividad";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/subactividad";
    </script>
    <?php
}





