<?php

include('../../config.php');

$id_manual = $_POST['id_manual'];

$sentencia = $pdo->prepare("UPDATE tb_manual SET 
visible=:visible,
fyh_actualizacion=:fyh_actualizacion WHERE id_manual=:id_manual");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_manual', $id_manual);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el manual de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/manual";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/manual";
    </script>
    <?php
}





