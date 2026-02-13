<?php

include('../../config.php');

$id_clasificador = $_GET['id_clasificador'];

$sentencia = $pdo->prepare("UPDATE tb_clasificador_cb SET 
visible=:visible,
fyh_actualizacion=:fyh_actualizacion WHERE id_clasificador=:id_clasificador");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_clasificador', $id_clasificador);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el clasificador de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/clasificador_cb";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/clasificador_cb";
    </script>
    <?php
}





