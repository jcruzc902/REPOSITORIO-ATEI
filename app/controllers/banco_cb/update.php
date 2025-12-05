<?php

include('../../config.php');

$nombre_banco_cb = mb_strtoupper($_GET['nombre_banco_cb']);
$id_banco_cb = $_GET['id_banco_cb'];

$sentencia = $pdo->prepare("UPDATE tb_banco_cb SET 
nombre_banco=:nombre_banco 
WHERE id_banco=:id_banco");

$sentencia->bindParam('nombre_banco', $nombre_banco_cb);
$sentencia->bindParam('id_banco', $id_banco_cb);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el nombre del banco de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/banco_cb";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/banco_cb";
    </script>
    <?php
}