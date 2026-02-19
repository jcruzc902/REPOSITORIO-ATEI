<?php

include('../../config.php');

$id_empresa = $_GET['id_empresa'];

$sentencia = $pdo->prepare("UPDATE tb_empresas SET 
visible=:visible,
fyh_actualizacion=:fyh_actualizacion WHERE id_empresa=:id_empresa");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_empresa', $id_empresa);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino la empresa de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/empresas";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/empresas";
    </script>
    <?php
}





