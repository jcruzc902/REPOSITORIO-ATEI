<?php

include('../../config.php');

$id_resoluciones_tyt = $_POST['id_resoluciones_tyt'];

$sentencia = $pdo->prepare("UPDATE tb_resoluciones_tyt SET 
visible=:visible WHERE id_resoluciones_tyt=:id_resoluciones_tyt");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_resoluciones_tyt', $id_resoluciones_tyt);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino la resolucion rectoral de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/resolucion_rectoral_tyt";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/resolucion_rectoral_tyt";
    </script>
    <?php
}





