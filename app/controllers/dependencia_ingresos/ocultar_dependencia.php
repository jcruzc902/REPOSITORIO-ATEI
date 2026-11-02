<?php

include('../../config.php');

$id_dependencia_ingresos = $_GET['id_dependencia_ingresos'];

$sentencia = $pdo->prepare("UPDATE tb_dependencia_ingresos SET 
visible=:visible WHERE id_dependencia_ingresos=:id_dependencia_ingresos");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_dependencia_ingresos', $id_dependencia_ingresos);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino la dependencia de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/dependencia_ingresos";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/dependencia_ingresos";
    </script>
    <?php
}





