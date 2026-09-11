<?php

include('../../config.php');

$id_banco_tyt = $_GET['id_banco_tyt'];

$sentencia = $pdo->prepare("UPDATE tb_banco_tyt SET 
visible=:visible WHERE id_banco_tyt=:id_banco_tyt");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_banco_tyt', $id_banco_tyt);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el nombre del banco de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/banco_sb";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/banco_sb";
    </script>
    <?php
}





