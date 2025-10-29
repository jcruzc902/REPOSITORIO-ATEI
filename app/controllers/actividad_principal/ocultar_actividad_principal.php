<?php

include('../../config.php');

$id_actividad_principal = $_GET['id_actividad_principal'];

$sentencia = $pdo->prepare("UPDATE tb_actividad_principal SET 
visible=:visible,
fyh_actualizacion=:fyh_actualizacion WHERE id_actividad_principal=:id_actividad_principal");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_actividad_principal', $id_actividad_principal);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino la actividad principal de la manera correcta";
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
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/actividad";
    </script>
    <?php
}





