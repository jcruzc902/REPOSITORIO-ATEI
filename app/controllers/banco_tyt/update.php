<?php

include('../../config.php');

$nombre_cuenta_tyt = mb_strtoupper($_GET['nombre_cuenta_tyt']);
$id_banco_tyt = $_GET['id_banco_tyt'];

$sentencia = $pdo->prepare("UPDATE tb_banco_tyt SET 
nombre_banco=:nombre_banco 
WHERE id_banco_tyt=:id_banco_tyt");

$sentencia->bindParam('nombre_banco', $nombre_cuenta_tyt);
$sentencia->bindParam('id_banco_tyt', $id_banco_tyt);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el nombre del banco de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/banco_sb";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/banco_sb";
    </script>
    <?php
}