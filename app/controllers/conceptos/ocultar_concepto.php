<?php

include('../../config.php');

$id_concepto = $_GET['id_concepto'];

$sentencia = $pdo->prepare("UPDATE tb_conceptos SET 
visible=:visible,
fyh_actualizacion=:fyh_actualizacion WHERE id_concepto=:id_concepto");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_concepto', $id_concepto);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el concepto de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/conceptos";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/conceptos";
    </script>
    <?php
}





