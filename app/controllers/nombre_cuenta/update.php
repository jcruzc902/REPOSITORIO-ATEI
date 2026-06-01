<?php

include('../../config.php');

$nombre_cuenta = mb_strtoupper($_GET['nombre_cuenta']);
$id_banco_cuenta = $_GET['id_banco_cuenta'];
$id_nombre_cuenta = $_GET['id_nombre_cuenta'];

$sentencia = $pdo->prepare("UPDATE tb_nombre_cuenta
SET nombre_cuenta=:nombre_cuenta,
id_numero_cuenta=:id_numero_cuenta,
fyh_actualizacion=:fyh_actualizacion
WHERE id_nombre_cuenta=:id_nombre_cuenta");

$sentencia->bindParam('nombre_cuenta', $nombre_cuenta);
$sentencia->bindParam('id_numero_cuenta', $id_banco_cuenta);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_nombre_cuenta', $id_nombre_cuenta);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el nombre de cuenta de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/nombre_sb";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/nombre_sb";
    </script>
    <?php
}





