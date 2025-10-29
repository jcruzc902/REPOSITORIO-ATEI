<?php

include('../../config.php');

$id_cargo = $_GET['id_cargo'];

$sentencia = $pdo->prepare("UPDATE tb_cargo SET 
visible=:visible,
fyh_actualizacion=:fyh_actualizacion WHERE id_cargo=:id_cargo");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_cargo', $id_cargo);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el cargo de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/cargo";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/cargo";
    </script>
    <?php
}





