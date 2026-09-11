<?php

include('../../config.php');

$id_dependencias_tyt = $_GET['id_dependencias_tyt'];

$sentencia = $pdo->prepare("UPDATE tb_dependencias_tyt SET 
visible=:visible WHERE id_dependencias_tyt=:id_dependencias_tyt");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_dependencias_tyt', $id_dependencias_tyt);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino la dependencia de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/dependencia_tyt";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/dependencia_tyt";
    </script>
    <?php
}





