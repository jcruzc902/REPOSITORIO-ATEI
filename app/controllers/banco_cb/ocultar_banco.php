<?php

include('../../config.php');

$id_banco_cb = $_GET['id_banco_cb'];

$sentencia = $pdo->prepare("UPDATE tb_banco_cb SET 
visible=:visible WHERE id_banco=:id_banco");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_banco', $id_banco_cb);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el nombre del banco de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/banco_cb";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/banco_cb";
    </script>
    <?php
}





