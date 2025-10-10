<?php

include('../../config.php');

$nombre_proveedor = mb_strtoupper($_GET['nombre_proveedor']);
$id_proveedor_cf = $_GET['id_proveedor_cf'];

$sentencia = $pdo->prepare("UPDATE tb_proveedor_cf SET 
nombre_proveedor=:nombre_proveedor 
WHERE id_proveedor_cf=:id_proveedor_cf");

$sentencia->bindParam('nombre_proveedor', $nombre_proveedor);
$sentencia->bindParam('id_proveedor_cf', $id_proveedor_cf);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el proveedor de la manera correcta";
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
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/proveedores";
    </script>
    <?php
}