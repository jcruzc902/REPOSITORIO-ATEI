<?php

include('../../config.php');

$id_cuenta_tyt = $_GET['id_cuenta_tyt'];

$sentencia = $pdo->prepare("UPDATE tb_cuenta_tyt SET 
visible=:visible WHERE id_cuenta_tyt=:id_cuenta_tyt");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_cuenta_tyt', $id_cuenta_tyt);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el numero de cuenta de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/cuenta_sb";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/cuenta_sb";
    </script>
    <?php
}





