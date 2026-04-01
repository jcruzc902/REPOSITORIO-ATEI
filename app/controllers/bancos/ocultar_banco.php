<?php

include('../../config.php');

$id_banco = $_GET['id_banco'];

$sentencia = $pdo->prepare("UPDATE tb_bancos SET 
visible=:visible,
fyh_actualizacion=:fyh_actualizacion WHERE id_banco=:id_banco");

$visible= 1;
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_banco', $id_banco);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el banco de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/bancos";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/bancos";
    </script>
    <?php
}





