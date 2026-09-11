<?php

include('../../config.php');

$id_banco_ingreso = $_GET['id_banco_ingreso'];

$sentencia = $pdo->prepare("UPDATE tb_banco_ingresos SET 
visible=:visible WHERE id_banco_ingreso=:id_banco_ingreso");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_banco_ingreso', $id_banco_ingreso);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el nombre del banco de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/banco_ingresos";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/banco_ingresos";
    </script>
    <?php
}





