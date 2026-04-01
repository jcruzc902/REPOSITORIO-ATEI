<?php

include('../../config.php');

$nombre_facultad = mb_strtoupper($_GET['nombre_facultad']);
$id_facultad = $_GET['id_facultad'];

$sentencia = $pdo->prepare("UPDATE tb_facultades_cb SET 
nombre_facultad=:nombre_facultad,
fyh_actualizacion=:fyh_actualizacion
WHERE id_facultad=:id_facultad");

$sentencia->bindParam('nombre_facultad', $nombre_facultad);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_facultad', $id_facultad);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo la dependencia de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/facultad_cb";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/facultad_cb";
    </script>
    <?php
}





