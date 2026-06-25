<?php

include('../../config.php');

$nombre_dependencia = mb_strtoupper($_GET['nombre_dependencia']);
$id_dependencia = $_GET['id_dependencia'];

$sentencia = $pdo->prepare("UPDATE tb_dependencias SET 
nombre=:nombre,
fyh_actualizacion=:fyh_actualizacion
WHERE id_dependencia=:id_dependencia");

$sentencia->bindParam('nombre', $nombre_dependencia);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_dependencia', $id_dependencia);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo la facultad o dependencia de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/dependencias";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/dependencias";
    </script>
    <?php
}





