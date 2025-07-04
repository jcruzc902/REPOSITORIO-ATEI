<?php

include('../../config.php');

$nombre_cargo = mb_strtoupper($_GET['nombre_cargo']);
$id_cargo = $_GET['id_cargo'];

$sentencia = $pdo->prepare("UPDATE tb_cargo SET 
nombre_cargo=:nombre_cargo,
fyh_actualizacion=:fyh_actualizacion
WHERE id_cargo=:id_cargo");

$sentencia->bindParam('nombre_cargo', $nombre_cargo);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_cargo', $id_cargo);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el cargo de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/cargo";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/cargo";
    </script>
    <?php
}





