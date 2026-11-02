<?php

include('../../config.php');

$id_subactividad = $_GET['id_subactividad'];

$sentencia = $pdo->prepare("UPDATE tb_subactividad SET 
visible=:visible,
fyh_actualizacion=:fyh_actualizacion WHERE id_subactividad=:id_subactividad");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_subactividad', $id_subactividad);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino la subactividad de la manera correcta";
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
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/subactividad";
    </script>
    <?php
}





