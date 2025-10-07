<?php

include('../../config.php');

$id_entidad_cf = $_GET['id_entidad_cf'];

$sentencia = $pdo->prepare("UPDATE tb_entidad_cf SET 
visible=:visible,
fyh_actualizacion=:fyh_actualizacion WHERE id_entidad_cf=:id_entidad_cf");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_entidad_cf', $id_entidad_cf);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino la entidad de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/entidades";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/entidades";
    </script>
    <?php
}





