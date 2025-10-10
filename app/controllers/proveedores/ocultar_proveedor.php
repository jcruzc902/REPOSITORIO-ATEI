<?php

include('../../config.php');

$id_proveedor_cf = $_GET['id_proveedor_cf'];

$sentencia = $pdo->prepare("UPDATE tb_proveedor_cf SET 
visible=:visible WHERE id_proveedor_cf=:id_proveedor_cf");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_proveedor_cf', $id_proveedor_cf);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el proveedor de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/proveedores";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/proveedores";
    </script>
    <?php
}





