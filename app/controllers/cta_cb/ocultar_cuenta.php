<?php

include('../../config.php');

$id_cta_cb = $_GET['id_cta_cb'];

$sentencia = $pdo->prepare("UPDATE tb_cta_cb SET 
visible=:visible WHERE id_cta=:id_cta");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_cta', $id_cta_cb);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el numero de cuenta de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/cuenta_cb";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/cuenta_cb";
    </script>
    <?php
}





