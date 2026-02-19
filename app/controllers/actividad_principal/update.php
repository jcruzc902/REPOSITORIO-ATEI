<?php

include('../../config.php');

$nombre_actividad = mb_strtoupper($_GET['nombre_actividad']);
$id_cargo = $_GET['id_cargo'];
$id_actividad_principal = $_GET['id_actividad_principal'];

$sentencia = $pdo->prepare("UPDATE tb_actividad_principal
SET nombre_actividad=:nombre_actividad,
id_cargo=:id_cargo,
fyh_actualizacion=:fyh_actualizacion
WHERE id_actividad_principal=:id_actividad_principal");

$sentencia->bindParam('nombre_actividad', $nombre_actividad);
$sentencia->bindParam('id_cargo', $id_cargo);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_actividad_principal', $id_actividad_principal);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo la actividad principal de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/actividad";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/actividad";
    </script>
    <?php
}





